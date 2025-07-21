<?php
include('./includes/connect.php');
include('./functions/common_func.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Bún đậu Ông Chú</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .checkout-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .order-summary {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .total-section {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .payment-method {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method:hover,
        .payment-method.active {
            border-color: #28a745;
            background-color: #f8fff9;
        }
        .delivery-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
    </style>
</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
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
                            <a class="nav-link" href="cart.php">Giỏ Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Total Price: <?php get_total_price();?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                </li>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center p-3">🛒 Thanh toán đơn hàng</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                </ol>
            </nav>
        </div>

        <!-- checkout content -->
        <div class="container my-5">
            <form action="process_order.php" method="POST" id="checkout-form">
                <div class="row">
                    <!-- Form thông tin khách hàng -->
                    <div class="col-lg-7">
                        <!-- Thông tin liên hệ -->
                        <div class="form-section">
                            <h4><i class="fas fa-user me-2"></i>Thông tin liên hệ</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Họ và tên *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customer_phone" class="form-label">Số điện thoại *</label>
                                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email (tùy chọn)</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email">
                            </div>
                        </div>

                        <!-- Địa chỉ giao hàng -->
                        <div class="form-section">
                            <h4><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng</h4>
                            <div class="mb-3">
                                <label for="delivery_address" class="form-label">Địa chỉ chi tiết *</label>
                                <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện"></textarea>
                            </div>
                            <div class="delivery-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Khu vực giao hàng:</strong> Trong bán kính 5km từ quán (Phí giao hàng: 15,000đ)
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="form-section">
                            <h4><i class="fas fa-credit-card me-2"></i>Phương thức thanh toán</h4>
                            
                            <div class="payment-method" onclick="selectPayment('cod')">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        <strong>Thanh toán khi nhận hàng (COD)</strong>
                                        <br><small class="text-muted">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                    </label>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectPayment('momo')">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                                    <label class="form-check-label" for="momo">
                                        <i class="fab fa-paypal me-2"></i>
                                        <strong>Ví MoMo</strong>
                                        <br><small class="text-muted">Thanh toán qua ví điện tử MoMo</small>
                                    </label>
                                </div>
                            </div>

                            <div class="payment-method" onclick="selectPayment('banking')">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">
                                        <i class="fas fa-university me-2"></i>
                                        <strong>Chuyển khoản ngân hàng</strong>
                                        <br><small class="text-muted">Chuyển khoản trước khi giao hàng</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Ghi chú -->
                        <div class="form-section">
                            <h4><i class="fas fa-sticky-note me-2"></i>Ghi chú đơn hàng</h4>
                            <textarea class="form-control" name="order_notes" rows="3" placeholder="Ghi chú thêm về đơn hàng (tùy chọn)..."></textarea>
                        </div>
                    </div>

                    <!-- Tóm tắt đơn hàng -->
                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h4><i class="fas fa-receipt me-2"></i>Tóm tắt đơn hàng</h4>
                            
                            <!-- Danh sách sản phẩm trong giỏ hàng -->
                            <div class="cart-items">
                                <?php
                                // Hiển thị sản phẩm trong giỏ hàng
                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                        // Lấy thông tin sản phẩm từ database
                                        $select_product = "SELECT * FROM products WHERE product_id = $product_id";
                                        $result_product = mysqli_query($conn, $select_product);
                                        if ($row_product = mysqli_fetch_assoc($result_product)) {
                                            $product_price = $row_product['product_price'];
                                            $product_title = $row_product['product_title'];
                                            $subtotal = $product_price * $quantity;
                                            $total += $subtotal;
                                            
                                            echo "<div class='cart-item d-flex justify-content-between align-items-center py-2 border-bottom'>
                                                    <div>
                                                        <strong>$product_title</strong><br>
                                                        <small class='text-muted'>Số lượng: $quantity</small>
                                                    </div>
                                                    <div class='text-end'>
                                                        <span class='fw-bold'>" . number_format($subtotal) . "đ</span>
                                                    </div>
                                                  </div>";
                                        }
                                    }
                                } else {
                                    echo "<p class='text-center text-muted'>Giỏ hàng trống</p>";
                                    $total = 0;
                                }
                                ?>
                            </div>

                            <!-- Tính toán tổng tiền -->
                            <div class="order-totals mt-3">
                                <div class="d-flex justify-content-between py-2">
                                    <span>Tạm tính:</span>
                                    <span id="subtotal"><?php echo isset($total) ? number_format($total) : '0'; ?>đ</span>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span>Phí giao hàng:</span>
                                    <span id="shipping-fee">15,000đ</span>
                                </div>
                                <hr>
                                <div class="total-section">
                                    <div class="d-flex justify-content-between">
                                        <strong>Tổng cộng:</strong>
                                        <strong id="total-amount"><?php echo isset($total) ? number_format($total + 15000) : '15,000'; ?>đ</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Nút đặt hàng -->
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-success btn-lg" name="place_order">
                                    <i class="fas fa-check me-2"></i>Đặt hàng
                                </button>
                                <a href="cart.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
                                </a>
                            </div>

                            <!-- Chính sách -->
                            <div class="mt-4 small text-muted">
                                <p><i class="fas fa-shield-alt me-2"></i>Đơn hàng của bạn được bảo vệ</p>
                                <p><i class="fas fa-truck me-2"></i>Giao hàng trong vòng 30-45 phút</p>
                                <p><i class="fas fa-phone me-2"></i>Hỗ trợ 24/7: 0123.456.789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- last child -->
        <?php include('./includes/footer.php'); ?>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>

    <script>
        // Chọn phương thức thanh toán
        function selectPayment(method) {
            // Bỏ class active khỏi tất cả payment methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            
            // Thêm class active cho method được chọn
            event.currentTarget.classList.add('active');
            
            // Check radio button
            document.getElementById(method).checked = true;
        }

        // Validate form trước khi submit
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            const name = document.getElementById('customer_name').value.trim();
            const phone = document.getElementById('customer_phone').value.trim();
            const address = document.getElementById('delivery_address').value.trim();

            if (!name || !phone || !address) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
                return false;
            }

            // Validate số điện thoại
            const phoneRegex = /^[0-9]{10,11}$/;
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                alert('Số điện thoại không hợp lệ!');
                return false;
            }

            return true;
        });

        // Set active cho payment method đầu tiên
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.payment-method').classList.add('active');
        });
    </script>
</body>

</html>