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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_allproducts.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cart.php">Giỏ Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item(); ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search_product.php" method="get">
                    <input name="search_data" class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" />
                    <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Tìm">
                </form>
            </div>
        </div>
    </nav>

    <!-- Cart function -->
    <?php
    if (isset($_GET['add_to_cart'])) {
        $product_id = $_GET['add_to_cart'];
        addToCart($product_id);
    }
    ?>

    <!-- Second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Chào mừng Khách</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Đăng nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Đăng ký</a>
            </li>
        </ul>
    </nav>

    <div class="container cart-container animate-fade-in">
        <div class="row">
            <div class="col-12">
                <div class="cart-header">
                    <h2><i class="fas fa-shopping-cart me-2"></i>Giỏ Hàng Của Bạn</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="cart-content">
                    <?php
                    $total = 0;
                    $cart_query = "SELECT * FROM `cart` WHERE ip_address='$ip'";
                    $result = mysqli_query($con, $cart_query);
                    
                    if (mysqli_num_rows($result) > 0) { ?>
                        <table class="table table-hover cart-table mb-0">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id'];
                                    $quantity = $row['quantity'];
                                    $product_query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id='$product_id'");
                                    $product = mysqli_fetch_assoc($product_query);

                                    $price = $product['product_price'];
                                    $subtotal = $price * $quantity;
                                    $total += $subtotal;
                                ?>
                                    <tr>
                                        <td>
                                            <h6 class="product-title"><?php echo htmlspecialchars($product['product_title']); ?></h6>
                                        </td>
                                        <td>
                                            <img src="./images/<?php echo $product['product_image']; ?>" class="cart_img" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
                                        </td>
                                        <td>
                                            <span class="product-price"><?php echo number_format($price); ?> VNĐ</span>
                                        </td>
                                        <td>
                                            <form method="post" action="" class="d-inline">
                                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                <div class="quantity-controls">
                                                    <input type="number" name="qty" value="<?php echo $quantity; ?>" min="1" max="99" class="quantity-input" />
                                                    <button type="submit" name="update_qty" class="btn btn-update">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <strong class="product-price"><?php echo number_format($subtotal); ?> VNĐ</strong>
                                        </td>
                                        <td>
                                            <a href="cart.php?remove=<?php echo $product_id; ?>" class="btn-remove" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                <i class="fas fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <h5>Giỏ hàng của bạn đang trống!</h5>
                            <p>Hãy thêm một số sản phẩm vào giỏ hàng để tiếp tục mua sắm.</p>
                            <a href="display_allproducts.php" class="btn btn-continue">
                                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua hàng
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4 col-md-5">
                <div class="cart-summary">
                    <h5><i class="fas fa-calculator me-2"></i>Tổng cộng đơn hàng</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span class="fw-bold"><?php echo number_format($total); ?> VNĐ</span>
                    </div>
                    <?php 
                    $shipping_fee = 0;
                    $distance_km = 5; // Mặc định 5km, bạn có thể lấy từ database hoặc form nhập
                    
                    if ($total < 100000) {
                        $shipping_fee = $distance_km * 10000; // 10,000 VNĐ/km
                    }
                    ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển:</span>
                        <?php if ($shipping_fee > 0): ?>
                            <span class="text-warning fw-bold"><?php echo number_format($shipping_fee); ?> VNĐ</span>
                        <?php else: ?>
                            <span class="text-success fw-bold">Miễn phí</span>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fs-5 fw-bold">Tổng cộng:</span>
                        <span class="total-price"><?php echo number_format($total + $shipping_fee); ?> VNĐ</span>
                    </div>
                    
                    <div class="mt-4">
                        <a href="display_allproducts.php" class="btn-continue">
                            <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua hàng
                        </a>
                        
                        <?php if ($total > 0): ?>
                            <a href="checkout.php" class="btn-checkout">
                                <i class="fas fa-credit-card me-2"></i>Thanh toán ngay
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if ($total > 0): ?>
                        <div class="mt-3 p-3 rounded" style="<?php echo ($shipping_fee > 0) ? 'background-color: #fff3cd; border: 1px solid #ffeaa7;' : 'background-color: #d1edff; border: 1px solid #bee5eb;'; ?>">
                            <small class="<?php echo ($shipping_fee > 0) ? 'text-warning' : 'text-info'; ?>">
                                <i class="fas fa-info-circle me-1"></i>
                                <?php if ($shipping_fee > 0): ?>
                                    Phí vận chuyển: <?php echo number_format($shipping_fee); ?> VNĐ (<?php echo $distance_km; ?>km × 10,000 VNĐ/km)<br>
                                    <strong>Mua thêm <?php echo number_format(100000 - $total); ?> VNĐ để được miễn phí vận chuyển!</strong>
                                <?php else: ?>
                                    🎉 Chúc mừng! Đơn hàng của bạn được <strong>miễn phí vận chuyển</strong>
                                <?php endif; ?>
                            </small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>