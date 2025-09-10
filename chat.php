<?php
session_start();
include "./model/pdo.php";

$pdo = new PDO("mysql:host=localhost;dbname=bundau;charset=utf8", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = trim($_POST["message"]);
    $products = [];

    // Query menu
    if (stripos($message, "menu") !== false || stripos($message, "có gì") !== false) {
        $stmt = $pdo->query("SELECT s.name, s.price, s.`describe`, d.name as danhmuc
                             FROM sanpham s
                             LEFT JOIN danhmuc d ON s.iddm = d.id");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $msgClean = str_ireplace("bún đậu", "", $message);
        $stmt = $pdo->prepare("SELECT s.name, s.price, s.`describe`, d.name as danhmuc
                               FROM sanpham s 
                               LEFT JOIN danhmuc d ON s.iddm = d.id
                               WHERE s.name LIKE ? OR s.`describe` LIKE ? OR d.name LIKE ? OR s.price LIKE ?");
        $stmt->execute(["%$msgClean%", "%$msgClean%", "%$msgClean%", "%$msgClean%"]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ghép dữ liệu thành context
    $context = "Menu hiện tại của quán:\n";
    if ($products && count($products) > 0) {
        foreach ($products as $p) {
            $desc = $p['describe'] ? $p['describe'] : "";
            $context .= "- {$p['name']} ({$p['danhmuc']}) | Giá: {$p['price']}K | {$desc}\n";
        }
    } else {
        $context .= "Không tìm thấy món nào phù hợp.\n";
    }

    // ====== QUAN TRỌNG: Lưu lịch sử chat ======
    if (!isset($_SESSION["chat_history"])) {
        $_SESSION["chat_history"] = [];
    }

    // Thêm tin nhắn người dùng
    $_SESSION["chat_history"][] = ["role" => "user", "content" => $message];

    // Tạo mảng messages gồm system + context + toàn bộ lịch sử
    $messages = [
        ["role" => "system", "content" => "Bạn là nhân viên phục vụ quán Bún Đậu. Luôn tư vấn dựa trên menu được cung cấp, không bịa thêm."],
        ["role" => "system", "content" => $context]
    ];
    $messages = array_merge($messages, $_SESSION["chat_history"]);

    // Gọi API OpenAI
    $apiKey = getenv('OPENAI_API_KEY') ?: 'DUMMY_KEY';
    $url = "https://api.openai.com/v1/chat/completions";

    $data = [
        "model" => "gpt-4.1-mini",
        "messages" => $messages
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result["choices"][0]["message"]["content"])) {
        $reply = $result["choices"][0]["message"]["content"];
        // Lưu reply của AI vào history
        $_SESSION["chat_history"][] = ["role" => "assistant", "content" => $reply];
        echo $reply;
    } else {
        echo "Xin lỗi, hiện tại hệ thống gặp sự cố khi trả lời.";
    }
}
