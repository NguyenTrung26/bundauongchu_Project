<?php
session_start();
include('./model/pdo.php'); // file kết nối CSDL MySQLi
$pdo = new PDO("mysql:host=localhost;dbname=bundau;charset=utf8", "root", "");

// Hàm xử lý trả lời chatbot
function chatbotReply($message)
{
    global $con;

    $msg = strtolower(trim($message));

    // 1. Chào hỏi
    if (strpos($msg, 'chào') !== false) {
        return "Xin chào bạn 👋! Bạn muốn gọi món gì ạ?";
    }

    // 2. Đặt món theo cú pháp: số lượng + tên món
    if (preg_match('/(\d+)\s*(.+)/', $msg, $matches)) {
        $qty = (int)$matches[1];
        $namepro = trim($matches[2]);

        $query = "SELECT * FROM sanpham WHERE name LIKE '%$namepro%' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $product = [
                $row['id'],
                $row['name'],
                $row['price'],
                $row['describe'],
                $row['img'],
                $qty,
                $row['price'] * $qty
            ];

            // Thêm vào session giỏ hàng
            $_SESSION['mycart'][] = $product;
            return "✅ Đã thêm $qty {$row['name']} vào giỏ hàng.";
        } else {
            return "❌ Xin lỗi, mình không tìm thấy món '$namepro'.";
        }
    }

    // 3. Xem giỏ hàng
    if (strpos($msg, 'giỏ hàng') !== false) {
        if (empty($_SESSION['mycart'])) {
            return "🛒 Giỏ hàng của bạn đang trống.";
        } else {
            $reply = "🛒 Giỏ hàng hiện tại:\n";
            foreach ($_SESSION['mycart'] as $item) {
                $reply .= "- {$item[4]} x {$item[1]}\n";
            }
            return $reply;
        }
    }

    return "🤖 Mình chưa hiểu. Bạn có thể thử: '2 bún đậu đầy đủ'.";
}

// Xử lý API AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = $_POST['message'] ?? '';

    if (!$msg) {
        echo json_encode(["reply" => "Bạn chưa nhập gì cả!"]);
        exit;
    }

    // Lấy user_id giả định (sau này thay bằng $_SESSION['user_id'])
    $user_id = 1;

    // Gọi hàm chatbot
    $reply = chatbotReply($msg);

    // Lưu vào database (cả user và bot)
    $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, role, message) VALUES (?, 'user', ?)");
    $stmt->execute([$user_id, $msg]);

    $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, role, message) VALUES (?, 'bot', ?)");
    $stmt->execute([$user_id, $reply]);

    // Trả kết quả JSON cho frontend
    echo json_encode(["reply" => nl2br($reply)]);
}
