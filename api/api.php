<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

function getFallbackMenu() {
    return [
        [
            'id' => 1,
            'category' => 'espresso',
            'cat' => 'espresso',
            'name' => 'Velvet Latte',
            'description' => 'Silky espresso with house-made vanilla foam.',
            'desc' => 'Silky espresso with house-made vanilla foam.',
            'price' => 280,
            'badge' => 'Best Seller',
            'img' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 2,
            'category' => 'cold',
            'cat' => 'cold',
            'name' => 'Iced Maple Cortado',
            'description' => 'Bold espresso and maple sweetness over ice.',
            'desc' => 'Bold espresso and maple sweetness over ice.',
            'price' => 260,
            'badge' => 'New',
            'img' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 3,
            'category' => 'food',
            'cat' => 'food',
            'name' => 'Honey Almond Toast',
            'description' => 'Toasted sourdough with almond cream and citrus.',
            'desc' => 'Toasted sourdough with almond cream and citrus.',
            'price' => 240,
            'badge' => 'Fresh',
            'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 4,
            'category' => 'seasonal',
            'cat' => 'seasonal',
            'name' => 'Spiced Cinnamon Mocha',
            'description' => 'Dark chocolate, cinnamon, and espresso.',
            'desc' => 'Dark chocolate, cinnamon, and espresso.',
            'price' => 300,
            'badge' => 'Seasonal',
            'img' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?auto=format&fit=crop&w=900&q=80'
        ]
    ];
}

function getFallbackRatings() {
    return [
        ['id' => 1, 'author_name' => 'Aisha', 'stars' => 5, 'review_text' => 'The best cappuccino in the city.'],
        ['id' => 2, 'author_name' => 'Michael', 'stars' => 5, 'review_text' => 'Warm atmosphere and excellent service.']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get_menu') {
        if ($dbConnected && $conn) {
            $stmt = $conn->query("SELECT * FROM menu_items ORDER BY id DESC");
            $menu_items = [];
            while($row = $stmt->fetch()) {
                $row['id'] = (int)$row['id'];
                $row['price'] = (int)$row['price'];
                $menu_items[] = $row;
            }
        } else {
            $menu_items = getFallbackMenu();
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
        if ($dbConnected && $conn) {
            $stmt = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
            $messages = [];
            while($row = $stmt->fetch()) {
                $messages[] = $row;
            }
        } else {
            $messages = [];
        }
        echo json_encode(["status" => "success", "data" => $messages]);
        exit;
    }

    if ($action === 'get_ratings') {
        if ($dbConnected && $conn) {
            $stmt = $conn->query("SELECT * FROM ratings WHERE status='approved' ORDER BY created_at DESC LIMIT 10");
            $ratings = [];
            while($row = $stmt->fetch()) {
                $ratings[] = $row;
            }
        } else {
            $ratings = getFallbackRatings();
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

        if ($dbConnected && $conn) {
            $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$first_name, $last_name, $email, $subject, $message])) {
                echo json_encode(["status" => "success", "message" => "Message saved successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error saving message"]);
            }
        } else {
            echo json_encode(["status" => "success", "message" => "Message received. Demo mode is active."]);
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

        if (!$dbConnected || !$conn) {
            echo json_encode(["status" => "success", "message" => "Order received. Demo mode is active."]);
            exit;
        }

        // Start transaction
        $conn->beginTransaction();

        try {
            $stmt = $conn->prepare("INSERT INTO orders (total_amount, tax_amount, grand_total) VALUES (?, ?, ?)");
            $stmt->execute([$total, $tax, $grand_total]);
            
            $order_id = $conn->lastInsertId();

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

        if (!$dbConnected || !$conn) {
            echo json_encode(["status" => "success", "message" => "Item added in demo mode"]);
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

        if (!$dbConnected || !$conn) {
            echo json_encode(["status" => "success", "message" => "Item deleted in demo mode"]);
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

        if (!$dbConnected || !$conn) {
            echo json_encode(["status" => "success", "message" => "Item updated in demo mode"]);
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

        if (!$dbConnected || !$conn) {
            echo json_encode(["status" => "success", "message" => "Rating submitted. Demo mode is active."]);
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
