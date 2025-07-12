<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bún đậu Ông Chú</title>
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
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info px-4">
            <img src="../images/logo.png" class="logo me-3" alt="" style="height: 40px;">
            <a class="navbar-brand fw-bold text-white" href="#">Admin Bún đậu Ông Chú</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="orders.php">Đơn hàng</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="menu.php">Thực đơn</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="customers.php">Khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
            <!-- Toggle Light/Dark Mode -->
            <div class="form-check form-switch text-white ms-3">
                <input class="form-check-input" type="checkbox" id="modeToggle">
                <label class="form-check-label" for="modeToggle">Dark mode</label>
            </div>

        </nav>

        <!-- second child -->
        <div class="bg-light py-3 border-bottom shadow-sm">
            <h3 class="text-center">Quản lý hệ thống</h3>
        </div>

        <!-- third child -->
        <div class="row m-0">
            <div class="col-md-12 bg-secondary text-center text-light py-3">
                <p class="mb-0 fs-5">Bún đậu Ông Chú - Quản lý đơn hàng, thực đơn và khách hàng</p>
            </div>
            <div class="button text-center my-4">
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="index.php?insert_product" class="btn btn-info text-white">Thêm sản phẩm</a>
                    <a href="index.php?view_products" class="btn btn-outline-info">Xem sản phẩm</a>
                    <a href="index.php?insert_cate" class="btn btn-info text-white">Thêm danh mục</a>
                    <a href="#" class="btn btn-outline-info">Xem danh mục</a>
                    <a href="#" class="btn btn-outline-info">Tất cả đơn hàng</a>
                    <a href="#" class="btn btn-outline-info">Tất cả khách hàng</a>
                    <a href="#" class="btn btn-outline-info">Tất cả danh mục</a>
                    <a href="#" class="btn btn-outline-info">Thanh toán</a>
                    <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-5">
            <?php
            if (isset($_GET['insert_cate'])) {
                include('insert_cate.php');
            }
            if (isset($_GET['insert_product'])) {
                include('insert_product.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <div class="bg-info text-center text-lg-start footer">
        <div class="text-center p-3">
            © 2023 Bún đậu Ông Chú. All rights reserved.
        </div>
    </div>

    <!-- bootstrap js -->
    <script>
        const toggleSwitch = document.getElementById('modeToggle');
        const body = document.body;

        // Kiểm tra lưu trong localStorage
        if (localStorage.getItem('dark-mode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleSwitch.checked = true;
        }

        toggleSwitch.addEventListener('change', () => {
            if (toggleSwitch.checked) {
                body.classList.add('dark-mode');
                localStorage.setItem('dark-mode', 'enabled');
            } else {
                body.classList.remove('dark-mode');
                localStorage.setItem('dark-mode', 'disabled');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>
</body>


</html>