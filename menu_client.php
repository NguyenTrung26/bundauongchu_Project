<?php
require __DIR__ . '/admin/db_connect.php';
$menu = $conn->query("SELECT * FROM menu_items WHERE status = 'Đang bán'");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đặt món - Bún Đậu Ông Chú</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4 text-center">🍽 Đặt món Bún Đậu Ông Chú</h2>
  
  <form method="POST" action="order_submit.php" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Họ tên khách hàng</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Số điện thoại</label>
      <input type="text" class="form-control" name="phone" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Chọn món ăn</label>
      <select name="item_id" class="form-select" required>
        <?php while ($item = $menu->fetch_assoc()) { ?>
          <option value="<?= $item['id'] ?>">
            <?= $item['name'] ?> - <?= number_format($item['price'], 0) ?>đ
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Số lượng</label>
      <input type="number" name="quantity" class="form-control" value="1" min="1" required>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary w-100">🚀 Gửi đơn đặt</button>
    </div>
  </form>
</div>
</body>
</html>
