<?php
include('../includes/connect.php');

// Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_product'])) {
    $product_title = htmlspecialchars(trim($_POST['product_title']));
    $product_desc = htmlspecialchars(trim($_POST['product_desc']));
    $product_price = floatval($_POST['product_price']);
    $cate_id = intval($_POST['cate_id']);
    $status_product = 'true';

    // Ảnh
    $product_image = $_FILES['product_image']['name'];
    $temp_image = $_FILES['product_image']['tmp_name'];

    if (empty($product_title) || empty($product_desc) || empty($product_price) || empty($product_image) || empty($cate_id)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.')</script>";
    } else {
        $image_extension = pathinfo($product_image, PATHINFO_EXTENSION);
        $unique_image_name = uniqid("prod_", true) . "." . $image_extension;
        move_uploaded_file($temp_image, "../images/$unique_image_name");

        $stmt = $con->prepare("INSERT INTO products (product_title, product_desc, product_price, product_image, cate_id, date_product, status_product) 
                               VALUES (?, ?, ?, ?, ?, NOW(), ?)");
        $stmt->bind_param("ssdsis", $product_title, $product_desc, $product_price, $unique_image_name, $cate_id, $status_product);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Sản phẩm đã được thêm thành công!'); window.location.href='insert_product.php';</script>";
        } else {
            echo "<script>alert('❌ Thêm thất bại: " . $stmt->error . "')</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm sản phẩm mới</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="product_title" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea class="form-control" name="product_desc" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" class="form-control" name="product_price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" name="product_image" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select class="form-select" name="cate_id" required>
                <option disabled selected>-- Chọn danh mục --</option>
                <?php
                $result = mysqli_query($con, "SELECT * FROM categories");
                while ($row = mysqli_fetch_assoc($result)) {
                    $cate_id = $row['cate_id'];
                    $cate_title = htmlspecialchars($row['cate_title']);
                    echo "<option value='$cate_id'>$cate_title</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="insert_product" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
</div>
</body>
</html>
