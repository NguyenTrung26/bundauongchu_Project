<?php
session_start();
include "../model/pdo.php";
include "../model/discount.php";

if (isset($_POST['create_discount'])) {
    $percent = intval($_POST['percent']);
    if ($percent > 0 && $percent <= 100) {
        $code = createDiscount($percent);
        $message = "Tạo mã giảm giá thành công: <b>$code</b> với $percent%";
    } else {
        $message = "Phần trăm giảm giá không hợp lệ!";
    }
}

if (isset($_GET['del']) && $_GET['del'] > 0) {
    $id = intval($_GET['del']);
    pdo_execute("DELETE FROM discount WHERE id = ?", $id);
    $message = "Xóa mã giảm giá thành công!";
}

$discounts = getAllDiscounts();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý mã giảm giá</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        .message { margin: 15px 0; padding: 10px; background: #e6ffe6; border: 1px solid #b2d8b2; }
        .error { background: #ffe6e6; border: 1px solid #d8b2b2; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Quản lý mã giảm giá</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Nhập phần trăm giảm giá (1 - 100):</label>
        <input type="number" name="percent" min="1" max="100" required>
        <button type="submit" name="create_discount">Tạo mã</button>
    </form>

    <h3>Danh sách mã giảm giá</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã Code</th>
            <th>Phần trăm giảm</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php if (!empty($discounts)): ?>
            <?php foreach ($discounts as $d): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><b><?= $d['code'] ?></b></td>
                    <td><?= $d['discount_percent'] ?>%</td>
                    <td><?= $d['is_used'] ? "Đã dùng" : "Chưa dùng" ?></td>
                    <td>
                        <a href="?del=<?= $d['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Chưa có mã giảm giá nào</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
