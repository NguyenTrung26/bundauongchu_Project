<?php
include('./includes/connect.php');
include('./functions/common_func.php');

$ip = getIPAddress();

// Xử lý cập nhật số lượng sản phẩm nếu người dùng thay đổi
if (isset($_POST['update_qty']) && isset($_POST['product_id'])) {
    $new_qty = intval($_POST['qty']);
    $product_id = $_POST['product_id'];
    if ($new_qty > 0) {
        $update_qty_query = "UPDATE `cart` SET quantity = '$new_qty' WHERE product_id='$product_id' AND ip_address='$ip'";
        mysqli_query($con, $update_qty_query);
    }
}

// Xử lý xóa sản phẩm
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    $delete_query = "DELETE FROM `cart` WHERE product_id='$product_id' AND ip_address='$ip'";
    mysqli_query($con, $delete_query);
    echo "<script>window.open('cart.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img {
            width: 100px;
            height: 100px;
        }

        .btn-update {
            width: 100%;
        }

        .btn-remove {
            width: 100%;
        }

        .cart-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-summary h5 {
            margin-bottom: 20px;
        }

        .cart-summary h4 {
            color: #dc3545;
        }

        .btn-outline-secondary {
            width: 100%;
        }

        .btn-success {
            width: 100%;
        }

        .btn-remove i {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary color-navbar navbar-fixed">
        <div class="container-fluid container-fluid_nav">
            <img class="logo-navbar" src="./images/logo.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_allproducts.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Giỏ Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item();
                                                                                                    ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>

                </ul>
                <form class="d-flex" role="search" action="search_product.php" method="get">
                    <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                    <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Search">
                </form>
            </div>
        </div>
    </nav>

    <!-- cart function -->
    <?php
    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        addToCart($product_id);
    }
    ?>
    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Wekcome Guest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>
    </nav>

    <div class="container my-4">
        <h2 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Giỏ Hàng Của Bạn</h2>

        <div class="row">
            <div class="col-md-9">
                <form method="post" action="">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
                            $result = mysqli_query($con, $cart_query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id'];
                                    $quantity = $row['quantity'];
                                    $product_query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id='$product_id'");
                                    $product = mysqli_fetch_assoc($product_query);

                                    $price = $product['product_price'];
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($product['product_title']); ?></td>
                                        <td><img src="./images/<?php echo $product['product_image']; ?>" class="cart_img"></td>
                                        <td><?php echo number_format($price); ?> VNĐ</td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                <input type="number" name="qty" value="<?php echo $quantity; ?>" min="1" class="form-control d-inline w-50" />
                                                <button type="submit" name="update_qty" class="btn btn-sm btn-outline-primary btn-update mt-1">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td><?php echo number_format($subtotal); ?> VNĐ</td>
                                        <td>
                                            <a href="cart.php?remove=<?php echo $product_id; ?>" class="btn btn-sm btn-danger btn-remove"><i class="fas fa-trash"></i> Xóa</a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-danger text-center py-3">🛒 Giỏ hàng của bạn đang trống!</h5>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>

            <!-- Tổng tiền -->
            <div class="col-md-3">
                <div class="cart-summary">
                    <h5>Tổng cộng:</h5>
                    <h4 class="text-danger"><?php echo number_format($total); ?> VNĐ</h4>
                    <a href="display_allproducts.php" class="btn btn-outline-secondary btn-sm d-block my-2">← Tiếp tục mua hàng</a>
                    <?php if ($total > 0): ?>
                        <a href="checkout.php" class="btn btn-success btn-sm d-block">🧾 Tiến hành thanh toán</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



    <?php include('./includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>