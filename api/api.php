<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get_menu') {
        $stmt = $conn->query("SELECT * FROM menu_items ORDER BY id DESC");
        $menu_items = [];
        while($row = $stmt->fetch()) {
            $row['id'] = (int)$row['id'];
            $row['price'] = (int)$row['price'];
            $menu_items[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $menu_items]);
        exit;
    }

    if ($action === 'get_messages') {
        $password = $_GET['password'] ?? '';
        if ($password !== 'admin123') {
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            exit;
        }
        $stmt = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        $messages = [];
        while($row = $stmt->fetch()) {
            $messages[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $messages]);
        exit;
    }

    if ($action === 'get_ratings') {
        $stmt = $conn->query("SELECT * FROM ratings WHERE status='approved' ORDER BY created_at DESC LIMIT 10");
        $ratings = [];
        while($row = $stmt->fetch()) {
            $ratings[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $ratings]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if ($action === 'submit_contact') {
        $first_name = $data['firstName'] ?? '';
        $last_name = $data['lastName'] ?? '';
        $email = $data['email'] ?? '';
        $subject = $data['subject'] ?? '';
        $message = $data['message'] ?? '';

        if (!$first_name || !$email || !$message) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$first_name, $last_name, $email, $subject, $message])) {
            echo json_encode(["status" => "success", "message" => "Message saved successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error saving message"]);
        }
        exit;
    }

    if ($action === 'submit_order') {
        $cart = $data['cart'] ?? [];
        $total = $data['total'] ?? 0;
        $tax = $data['tax'] ?? 0;
        $grand_total = $data['grandTotal'] ?? 0;

        if (empty($cart)) {
            echo json_encode(["status" => "error", "message" => "Cart is empty"]);
            exit;
        }

        // Start transaction
        $conn->beginTransaction();

        try {
            $stmt = $conn->prepare("INSERT INTO orders (total_amount, tax_amount, grand_total) VALUES (?, ?, ?)");
            $stmt->execute([$total, $tax, $grand_total]);
            
            // Get the inserted ID
            // For Postgres, lastInsertId sometimes requires the sequence name, but usually works without it if driver supports it, or use RETURNING id
            $order_id = $conn->lastInsertId();
            
            // If lastInsertId() doesn't work out-of-the-box in PDO PGSQL for a table,
            // we'll rely on it, but generally it's safer with RETURNING. However, PDO pgsql supports lastInsertId() with no args for the last sequence used.

            $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($cart as $item) {
                $stmt->execute([$order_id, $item['id'], $item['qty'], $item['price']]);
            }

            $conn->commit();
            echo json_encode(["status" => "success", "message" => "Order placed successfully"]);
        } catch (Exception $e) {
            $conn->rollBack();
            echo json_encode(["status" => "error", "message" => "Failed to process order: " . $e->getMessage()]);
        }
        exit;
    }

    if ($action === 'add_item') {
        // Simple security check (in a real app, use sessions)
        $password = $data['password'] ?? '';
        if ($password !== 'admin123') {
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            exit;
        }

        $category = $data['category'] ?? '';
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = (int)($data['price'] ?? 0);
        $badge = $data['badge'] ?? '';
        $img = $data['img'] ?? '';

        if (!$category || !$name || !$description || !$price || !$img) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO menu_items (category, name, description, price, badge, img) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$category, $name, $description, $price, $badge, $img])) {
            echo json_encode(["status" => "success", "message" => "Item added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error adding item"]);
        }
        exit;
    }

    if ($action === 'delete_item') {
        $password = $data['password'] ?? '';
        if ($password !== 'admin123') {
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            exit;
        }

        $id = (int)($data['id'] ?? 0);
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "Invalid item ID"]);
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
        
        if ($stmt->execute([$id])) {
            echo json_encode(["status" => "success", "message" => "Item deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting item"]);
        }
        exit;
    }

    if ($action === 'update_item') {
        $password = $data['password'] ?? '';
        if ($password !== 'admin123') {
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            exit;
        }

        $id = (int)($data['id'] ?? 0);
        $category = $data['category'] ?? '';
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = (int)($data['price'] ?? 0);
        $badge = $data['badge'] ?? '';
        $img = $data['img'] ?? '';

        if (!$id || !$category || !$name || !$description || !$price || !$img) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("UPDATE menu_items SET category=?, name=?, description=?, price=?, badge=?, img=? WHERE id=?");
        
        if ($stmt->execute([$category, $name, $description, $price, $badge, $img, $id])) {
            echo json_encode(["status" => "success", "message" => "Item updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating item"]);
        }
        exit;
    }

    if ($action === 'submit_rating') {
        $author = $data['author'] ?? '';
        $stars = (int)($data['stars'] ?? 0);
        $review = $data['review'] ?? '';

        if (!$author || !$review || $stars < 1 || $stars > 5) {
            echo json_encode(["status" => "error", "message" => "Invalid rating data"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO ratings (author_name, stars, review_text) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$author, $stars, $review])) {
            echo json_encode(["status" => "success", "message" => "Rating submitted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error submitting rating"]);
        }
        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Invalid action"]);
$conn = null;
?>
