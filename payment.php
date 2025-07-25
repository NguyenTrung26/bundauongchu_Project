<?php
include('../includes/connect.php');
include('../functions/common_func.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Bún đậu Ông Chú</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesuper.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --dark-color: #1f2937;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            line-height: 1.6;
            color: var(--dark-color);
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .navbar.bg-secondary {
            background: var(--primary-color) !important;
        }

        .logo-navbar {
            height: 50px;
            width: auto;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Main Container */
        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            justify-content: center;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Form Sections */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            width: 24px;
            height: 24px;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        /* Form Controls */
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fafbfc;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background-color: white;
        }

        .form-control:valid {
            border-color: var(--success-color);
        }

        /* Payment Methods */
        .payment-method {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .payment-method::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .payment-method:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .payment-method.active {
            border-color: var(--success-color);
            background: linear-gradient(45deg, rgba(37, 99, 235, 0.05), rgba(5, 150, 105, 0.05));
            box-shadow: var(--shadow-md);
        }

        .payment-method .form-check-label {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .payment-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            color: white;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        /* Order Summary */
        .order-summary {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: sticky;
            top: 2rem;
            overflow: hidden;
        }

        .order-summary-header {
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            color: white;
            padding: 1.5rem;
            margin: -1px -1px 0 -1px;
        }

        .order-summary-body {
            padding: 1.5rem;
        }

        .cart-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-info h6 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .item-quantity {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .item-price {
            font-weight: 600;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        /* Order Totals */
        .order-totals {
            border-top: 2px solid var(--border-color);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .total-final {
            background: linear-gradient(45deg, var(--success-color), #059669);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            font-size: 1.125rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--success-color));
            border: none;
            border-radius: 8px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-outline-custom {
            border: 2px solid var(--border-color);
            color: var(--dark-color);
            background: white;
            border-radius: 8px;
            padding: 0.875rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(37, 99, 235, 0.05);
        }

        /* Info Cards */
        .info-card {
            background: linear-gradient(45deg, #eff6ff, #f0f9ff);
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .info-card.warning {
            background: linear-gradient(45deg, #fffbeb, #fef3c7);
            border-color: #fbbf24;
        }

        .info-card.success {
            background: linear-gradient(45deg, #ecfdf5, #d1fae5);
            border-color: #10b981;
        }

        .policy-list {
            list-style: none;
            padding: 0;
        }

        .policy-list li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .policy-list li i {
            color: var(--success-color);
            width: 16px;
        }

        /* Progress Steps */
        .checkout-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 3rem;
            padding: 0 2rem;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background: white;
            border: 2px solid var(--border-color);
            font-weight: 500;
            position: relative;
        }

        .step.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .step.completed {
            background: var(--success-color);
            color: white;
            border-color: var(--success-color);
        }

        .step-connector {
            width: 60px;
            height: 2px;
            background: var(--border-color);
            margin: 0 1rem;
        }

        .step-connector.active {
            background: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .checkout-container {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .order-summary {
                position: static;
                margin-top: 2rem;
            }

            .checkout-steps {
                flex-direction: column;
                gap: 1rem;
            }

            .step-connector {
                width: 2px;
                height: 30px;
                margin: 0.5rem 0;
            }
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form validation styles */
        .is-invalid {
            border-color: var(--danger-color) !important;
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .is-valid {
            border-color: var(--success-color) !important;
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
                            <a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item();
                                                                                                                ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">Liên hệ</a>
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

    <!-- Main Content -->
    <div class="checkout-container" style="margin-top: 100px;">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-shopping-cart me-3"></i>Thanh toán</h1>
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active">Thanh toán</li>
                </ol>
            </nav> -->
        </div>

        <!-- Checkout Steps -->
        <!-- <div class="checkout-steps">
            <div class="step completed">
                <i class="fas fa-shopping-cart"></i>
                <span>Giỏ hàng</span>
            </div>
            <div class="step-connector active"></div>
            <div class="step active">
                <i class="fas fa-credit-card"></i>
                <span>Thanh toán</span>
            </div>
            <div class="step-connector"></div>
            <div class="step">
                <i class="fas fa-check-circle"></i>
                <span>Hoàn thành</span>
            </div>
        </div> -->

        <form action="process_order.php" method="POST" id="checkout-form" novalidate>
            <div class="row">
                <!-- Customer Information Form -->
                <div class="col-lg-7">
                    <!-- Contact Information -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-user"></i>
                            Thông tin liên hệ
                        </h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_name" class="form-label">
                                    Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập họ và tên
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customer_phone" class="form-label">
                                    Số điện thoại <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập số điện thoại hợp lệ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email (tùy chọn)</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email">
                            <div class="invalid-feedback">
                                Vui lòng nhập email hợp lệ
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Địa chỉ giao hàng
                        </h4>
                        <div class="mb-3">
                            <label for="delivery_address" class="form-label">
                                Địa chỉ chi tiết <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện"></textarea>
                            <div class="invalid-feedback">
                                Vui lòng nhập địa chỉ giao hàng
                            </div>
                        </div>
                        <div class="info-card warning">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Khu vực giao hàng:</strong> Trong bán kính 5km từ quán (Phí giao hàng: 15,000đ)
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-credit-card"></i>
                            Phương thức thanh toán
                        </h4>
                        
                        <div class="payment-method active" onclick="selectPayment('cod')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    <div class="d-flex align-items-center">
                                        <div class="payment-icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div>
                                            <strong>Thanh toán khi nhận hàng (COD)</strong>
                                            <br><small class="text-muted">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-method" onclick="selectPayment('momo')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                                <label class="form-check-label" for="momo">
                                    <div class="d-flex align-items-center">
                                        <div class="payment-icon">
                                            <i class="fab fa-cc-mastercard"></i>
                                        </div>
                                        <div>
                                            <strong>Ví MoMo</strong>
                                            <br><small class="text-muted">Thanh toán qua ví điện tử MoMo</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-method" onclick="selectPayment('banking')">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="banking" value="banking">
                                <label class="form-check-label" for="banking">
                                    <div class="d-flex align-items-center">
                                        <div class="payment-icon">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <strong>Chuyển khoản ngân hàng</strong>
                                            <br><small class="text-muted">Chuyển khoản trước khi giao hàng</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-sticky-note"></i>
                            Ghi chú đơn hàng
                        </h4>
                        <textarea class="form-control" name="order_notes" rows="3" placeholder="Ghi chú thêm về đơn hàng (tùy chọn)..."></textarea>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="order-summary">
                        <div class="order-summary-header">
                            <h4 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>
                                Tóm tắt đơn hàng
                            </h4>
                        </div>
                        
                        <div class="order-summary-body">
                            <!-- Cart Items -->
                            <div class="cart-items">
                                <!-- Sample items - replace with PHP loop -->
                                <div class="cart-item">
                                    <div class="item-info">
                                        <h6>Bún đậu mắm tôm</h6>
                                        <div class="item-quantity">Số lượng: 2</div>
                                    </div>
                                    <div class="item-price">85,000đ</div>
                                </div>
                                
                                <div class="cart-item">
                                    <div class="item-info">
                                        <h6>Nem chua rán</h6>
                                        <div class="item-quantity">Số lượng: 1</div>
                                    </div>
                                    <div class="item-price">25,000đ</div>
                                </div>

                                <div class="cart-item">
                                    <div class="item-info">
                                        <h6>Chả cá thăng long</h6>
                                        <div class="item-quantity">Số lượng: 1</div>
                                    </div>
                                    <div class="item-price">35,000đ</div>
                                </div>
                            </div>

                            <!-- Order Totals -->
                            <div class="order-totals">
                                <div class="total-row">
                                    <span>Tạm tính:</span>
                                    <span id="subtotal">145,000đ</span>
                                </div>
                                <div class="total-row">
                                    <span>Phí giao hàng:</span>
                                    <span id="shipping-fee">15,000đ</span>
                                </div>
                                <div class="total-final">
                                    <div class="d-flex justify-content-between">
                                        <strong>Tổng cộng:</strong>
                                        <strong id="total-amount">160,000đ</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary-custom btn-lg" name="place_order">
                                    <i class="fas fa-check me-2"></i>Đặt hàng ngay
                                </button>
                                <a href="cart.php" class="btn btn-outline-custom">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
                                </a>
                            </div>

                            <!-- Policies -->
                            <div class="info-card success mt-4">
                                <ul class="policy-list">
                                    <li>
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Đơn hàng của bạn được bảo vệ</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-truck"></i>
                                        <span>Giao hàng trong vòng 30-45 phút</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-phone"></i>
                                        <span>Hỗ trợ 24/7: 0374.053.170</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-sync-alt"></i>
                                        <span>Đổi trả trong 24h nếu có vấn đề</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Payment method selection
        function selectPayment(method) {
            // Remove active class from all payment methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to selected method
            event.currentTarget.classList.add('active');
            
            // Check the radio button
            document.getElementById(method).checked = true;
        }

        // Form validation
        function validateForm() {
            const form = document.getElementById('checkout-form');
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;

            inputs.forEach(input => {
                const value = input.value.trim();
                
                if (!value) {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    isValid = false;
                } else {
                    // Special validation for phone
                    if (input.type === 'tel') {
                        const phoneRegex = /^[0-9]{10,11}$/;
                        if (!phoneRegex.test(value)) {
                            input.classList.add('is-invalid');
                            input.classList.remove('is-valid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        }
                    }
                    // Special validation for email
                    else if (input.type === 'email' && value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(value)) {
                            input.classList.add('is-invalid');
                            input.classList.remove('is-valid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        }
                    } else {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    }
                }
            });

            return isValid;
        }

        // Real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkout-form');
            const inputs = form.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });
        });

        function validateField(field) {
            const value = field.value.trim();
            
            if (field.hasAttribute('required') && !value) {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
                return false;
            }

            if (field.type === 'tel' && value) {
                const phoneRegex = /^[0-9]{10,11}$/;
                if (!phoneRegex.test(value)) {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    return false;
                }
            }

            if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    return false;
                }
            }

            field.classList.remove('is-invalid');
            if (value) {
                field.classList.add('is-valid');
            }
            return true;
        }

        // Form submission
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                // Scroll to first invalid field
                const firstInvalid = document.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                
                // Show notification
                showNotification('Vui lòng kiểm tra lại thông tin!', 'error');
                return false;
            }

            // Show loading
            showLoading();
            
            // Show success notification after 2 seconds (simulate processing)
            setTimeout(() => {
                hideLoading();
                showNotification('Đơn hàng đã được gửi thành công!', 'success');
                
                // You can submit the form here or redirect
                // this.submit();
            }, 2000);
        });

        // Loading functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());

            const notification = document.createElement('div');
            notification.className = `notification alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                border-radius: 8px;
            `;
            
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : type === 'success' ? 'fa-check-circle' : 'fa-info-circle'} me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Dynamic pricing calculation (example)
        function updateTotals() {
            const subtotal = 145000;
            const shipping = 15000;
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString('vi-VN') + 'đ';
            document.getElementById('shipping-fee').textContent = shipping.toLocaleString('vi-VN') + 'đ';
            document.getElementById('total-amount').textContent = total.toLocaleString('vi-VN') + 'đ';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Set first payment method as active
            const firstPaymentMethod = document.querySelector('.payment-method');
            if (firstPaymentMethod) {
                firstPaymentMethod.classList.add('active');
            }

            // Update totals
            updateTotals();

            // Add smooth animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'slideInUp 0.6s ease forwards';
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.form-section, .order-summary').forEach(el => {
                observer.observe(el);
            });
        });

        // Add CSS animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .form-section, .order-summary {
                opacity: 0;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>