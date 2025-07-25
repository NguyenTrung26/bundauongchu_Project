<?php
require __DIR__ . '/vendor/autoload.php'; // Autoload mới
require __DIR__ . '/includes/connect.php'; // Kết nối cơ sở dữ liệu

use Mpdf\Mpdf;

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
  die("❌ Đơn hàng không tồn tại.");
}

$html = '
<h2 style="text-align:center;">HÓA ĐƠN BÁN HÀNG</h2>
<p><strong>Khách hàng:</strong> ' . htmlspecialchars($order['customer_name']) . '</p>
<p><strong>Số điện thoại:</strong> ' . htmlspecialchars($order['phone']) . '</p>
<p><strong>Ngày đặt:</strong> ' . $order['order_time'] . '</p>
<hr>
<p><strong>Món:</strong> ' . $order['item_name'] . '</p>
<p><strong>Số lượng:</strong> ' . $order['quantity'] . '</p>
<p><strong>Tổng tiền:</strong> ' . number_format($order['total_price'], 0) . 'đ</p>
';

$filename = "hoadon_donhang_{$id}.pdf";
$savePath = __DIR__ . "/hoadon_luu/$filename";
if (!file_exists(__DIR__ . '/hoadon_luu')) mkdir(__DIR__ . '/hoadon_luu');

$mpdf = new Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output($savePath, 'F');
$mpdf->Output($filename, 'I');
