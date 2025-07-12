<?php
session_start();
require __DIR__ . '/admin/db_connect.php';


$name = $_POST['name'];
$phone = $_POST['phone'];
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];

$result = $conn->query("SELECT * FROM menu_items WHERE id = $item_id");
$item = $result->fetch_assoc();

if (!$item) {
  die("Món không tồn tại.");
}

$item_name = $item['name'];
$unit_price = $item['price'];
$total_price = $unit_price * $quantity;

$stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, item_name, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $name, $phone, $item_name, $quantity, $total_price);
$stmt->execute();

$order_id = $conn->insert_id;

// ✅ Cho phép khách xem hóa đơn sau khi đặt
$_SESSION['last_order_id'] = $order_id;
header("Location: view_invoice.php?id=$order_id");
exit();
