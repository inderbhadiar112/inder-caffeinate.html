<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get_menu') {
        $result = $conn->query("SELECT * FROM menu_items ORDER BY id DESC");
        $menu_items = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $row['id'] = (int)$row['id'];
                $row['price'] = (int)$row['price'];
                $menu_items[] = $row;
            }
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
        $result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        $messages = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }
        echo json_encode(["status" => "success", "data" => $messages]);
        exit;
    }

    if ($action === 'get_ratings') {
        $result = $conn->query("SELECT * FROM ratings WHERE status='approved' ORDER BY created_at DESC LIMIT 10");
        $ratings = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ratings[] = $row;
            }
        }
        echo json_encode(["status" => "success", "data" => $ratings]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if ($action === 'submit_contact') {
        $first_name = $conn->real_escape_string($data['firstName'] ?? '');
        $last_name = $conn->real_escape_string($data['lastName'] ?? '');
        $email = $conn->real_escape_string($data['email'] ?? '');
        $subject = $conn->real_escape_string($data['subject'] ?? '');
        $message = $conn->real_escape_string($data['message'] ?? '');

        if (!$first_name || !$email || !$message) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Message saved successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error saving message"]);
        }
        $stmt->close();
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
        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("INSERT INTO orders (total_amount, tax_amount, grand_total) VALUES (?, ?, ?)");
            $stmt->bind_param("ddd", $total, $tax, $grand_total);
            $stmt->execute();
            $order_id = $stmt->insert_id;
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($cart as $item) {
                $stmt->bind_param("iiii", $order_id, $item['id'], $item['qty'], $item['price']);
                $stmt->execute();
            }
            $stmt->close();

            $conn->commit();
            echo json_encode(["status" => "success", "message" => "Order placed successfully"]);
        } catch (Exception $e) {
            $conn->rollback();
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

        $category = $conn->real_escape_string($data['category'] ?? '');
        $name = $conn->real_escape_string($data['name'] ?? '');
        $description = $conn->real_escape_string($data['description'] ?? '');
        $price = (int)($data['price'] ?? 0);
        $badge = $conn->real_escape_string($data['badge'] ?? '');
        $img = $conn->real_escape_string($data['img'] ?? '');

        if (!$category || !$name || !$description || !$price || !$img) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO menu_items (category, name, description, price, badge, img) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdss", $category, $name, $description, $price, $badge, $img);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Item added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error adding item"]);
        }
        $stmt->close();
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
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Item deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting item"]);
        }
        $stmt->close();
        exit;
    }

    if ($action === 'update_item') {
        $password = $data['password'] ?? '';
        if ($password !== 'admin123') {
            echo json_encode(["status" => "error", "message" => "Unauthorized"]);
            exit;
        }

        $id = (int)($data['id'] ?? 0);
        $category = $conn->real_escape_string($data['category'] ?? '');
        $name = $conn->real_escape_string($data['name'] ?? '');
        $description = $conn->real_escape_string($data['description'] ?? '');
        $price = (int)($data['price'] ?? 0);
        $badge = $conn->real_escape_string($data['badge'] ?? '');
        $img = $conn->real_escape_string($data['img'] ?? '');

        if (!$id || !$category || !$name || !$description || !$price || !$img) {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
            exit;
        }

        $stmt = $conn->prepare("UPDATE menu_items SET category=?, name=?, description=?, price=?, badge=?, img=? WHERE id=?");
        $stmt->bind_param("sssdssi", $category, $name, $description, $price, $badge, $img, $id);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Item updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating item"]);
        }
        $stmt->close();
        exit;
    }

    if ($action === 'submit_rating') {
        $author = $conn->real_escape_string($data['author'] ?? '');
        $stars = (int)($data['stars'] ?? 0);
        $review = $conn->real_escape_string($data['review'] ?? '');

        if (!$author || !$review || $stars < 1 || $stars > 5) {
            echo json_encode(["status" => "error", "message" => "Invalid rating data"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO ratings (author_name, stars, review_text) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $author, $stars, $review);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Rating submitted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error submitting rating"]);
        }
        $stmt->close();
        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Invalid action"]);
$conn->close();
?>
