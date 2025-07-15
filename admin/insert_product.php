<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <?php
    include('link.php');
    include('../includes/connect.php');
    if (isset($_POST['insert_product'])) {
        $product_title = $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $cate_id = $_POST['cate_id'];
        $status_product = 'true'; // Default status for new products
        $product_image = $_FILES['product_image']['name'];
        $temp_image = $_FILES['product_image']['tmp_name'];


        // Move the uploaded image to the server
        move_uploaded_file($temp_image, "../images/$product_image");

        // check empty fields
        if (empty($product_title) || empty($product_desc) || empty($product_price) || empty($product_image) || empty($cate_id)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin sản phẩm.')</script>";
            return;
        }
        // Insert product into database
        $insert_product = "INSERT INTO products (product_title, product_desc, product_price, product_image, cate_id, date_product, status_product) 
                            VALUES ('$product_title', '$product_desc', '$product_price', '$product_image', '$cate_id', NOW(), '$status_product')";
        $result_insert = mysqli_query($con, $insert_product);

        if ($result_insert) {
            echo "<script>alert('Sản phẩm đã được thêm thành công!')</script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm sản phẩm. Vui lòng thử lại.')</script>";
        }
    }
    ?>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm sản phẩm mới</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_title" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_title" name="product_title" required>
            </div>
            <div class="mb-3">
                <label for="product_desc" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="product_desc" name="product_desc" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" id="product_price" name="product_price" required>
            </div>
            <div class="mb-3">
                <label for="product_image" class="form-label">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="product_category" class="form-label">Danh mục sản phẩm</label>
                <select class="form-select" id="product_category" name="cate_id" required>
                    <?php
                    include('../includes/connect.php');
                    $select_categories = "SELECT * FROM categories";
                    $result_categories = mysqli_query($con, $select_categories);
                    while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                        $cate_title = $row_categories['cate_title'];
                        $cate_id = $row_categories['cate_id'];
                        echo "<option value='$cate_id'>$cate_title</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="insert_product" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
        <?php
        if (isset($_POST['insert_product'])) {
            $product_title = $_POST['product_title'];
            $product_desc = $_POST['product_desc'];
            $product_price = $_POST['product_price'];
            $cate_id = $_POST['cate_id'];
            $product_image = $_FILES['product_image']['name'];
            $temp_image = $_FILES['product_image']['tmp_name'];

            // Move the uploaded image to the server
            move_uploaded_file($temp_image, "../images/$product_image");

            // Insert product into database
            $insert_query = "INSERT INTO products (product_title, product_desc, product_price, product_image, cate_id) 
                             VALUES ('$product_title', '$product_desc', '$product_price', '$product_image', '$cate_id')";
            $result_insert = mysqli_query($con, $insert_query);

            if ($result_insert) {
                echo "<script>alert('Sản phẩm đã được thêm thành công!')</script>";
                echo "<script>window.open('index.php?view_products', '_self')</script>";
            } else {
                echo "<script>alert('Lỗi khi thêm sản phẩm. Vui lòng thử lại.')</script>";
            }
        }
        ?>
    </div>
</body>

</html>