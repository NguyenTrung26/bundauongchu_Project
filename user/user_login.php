<?php
include('../includes/connect.php');
include('../functions/common_func.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bún đậu Ông Chú - Đăng nhập</title>
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
    <link rel="stylesheet" href="../stylesuper.css">
    <style>
        .login-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .login-form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: rgb(179, 85, 7);
            font-weight: bold;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            margin: 0;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-floating input {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-floating input:focus {
            border-color: rgb(179, 85, 7);
            box-shadow: 0 0 0 0.2rem rgba(179, 85, 7, 0.25);
        }
        .btn-login {
            background: linear-gradient(45deg, rgb(179, 85, 7), rgb(200, 100, 20));
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: linear-gradient(45deg, rgb(150, 70, 5), rgb(179, 85, 7));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(179, 85, 7, 0.3);
        }
        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ddd;
        }
        .divider span {
            background: white;
            padding: 0 15px;
            color: #666;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: rgb(179, 85, 7);
            text-decoration: none;
            font-weight: bold;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .alert-custom {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle .toggle-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            z-index: 5;
        }
    </style>
</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary color-navbar navbar-fixed">
            <div class="container-fluid container-fluid_nav">
                <img class="logo-navbar" src="../images/logo.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_allproducts.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php">Giỏ Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a href="../cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><sup><?php display_cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Total Price: <?php get_total_price(); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <input type="submit" name="search_data_product" class="btn btn-outline-success" value="Search">
                    </form>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if(isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Chào mừng " . $_SESSION['username'] . "</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='../logout.php'>Đăng xuất</a>
                          </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Chào mừng khách</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='user_login.php'>Đăng nhập</a>
                          </li>
                          <li class='nav-item'>
                            <a class='nav-link' href='user_regis.php'>Đăng ký</a>
                          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center p-3">Bún đậu Ông Chú</h3>
            <p class="text-center">Chuyên cung cấp các món bún đậu truyền thống Việt Nam</p>
        </div>

        <!-- Login Form -->
        <div class="login-container">
            <div class="login-form-container">
                <div class="login-header">
                    <h2><i class="fas fa-user-circle"></i> Đăng nhập</h2>
                    <p>Chào mừng bạn quay trở lại!</p>
                </div>

                <?php
                if(isset($_POST['user_login'])) {
                    $username = mysqli_real_escape_string($con, $_POST['user_username']);
                    $password = $_POST['user_password'];
                    
                    $select_query = "SELECT * FROM user_table WHERE username='$username'";
                    $result = mysqli_query($con, $select_query);
                    $row_count = mysqli_num_rows($result);
                    $row_data = mysqli_fetch_assoc($result);
                    
                    if($row_count > 0) {
                        if(password_verify($password, $row_data['user_password'])) {
                            $_SESSION['username'] = $username;
                            $_SESSION['user_id'] = $row_data['user_id'];
                            echo "<div class='alert alert-success alert-custom'>
                                    <i class='fas fa-check-circle'></i> Đăng nhập thành công! Đang chuyển hướng...
                                  </div>";
                            echo "<script>
                                    setTimeout(function() {
                                        window.location.href = '../index.php';
                                    }, 1500);
                                  </script>";
                        } else {
                            echo "<div class='alert alert-danger alert-custom'>
                                    <i class='fas fa-exclamation-triangle'></i> Mật khẩu không đúng!
                                  </div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger alert-custom'>
                                <i class='fas fa-user-times'></i> Tài khoản không tồn tại!
                              </div>";
                    }
                }
                ?>

                <form action="" method="post" id="loginForm">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="user_username" name="user_username" 
                               placeholder="Tên đăng nhập" autocomplete="username" required>
                        <label for="user_username"><i class="fas fa-user"></i> Tên đăng nhập</label>
                    </div>

                    <div class="form-floating password-toggle">
                        <input type="password" class="form-control" id="user_password" name="user_password" 
                               placeholder="Mật khẩu" autocomplete="current-password" required>
                        <label for="user_password"><i class="fas fa-lock"></i> Mật khẩu</label>
                        <button type="button" class="toggle-btn" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login" name="user_login">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </button>
                </form>

                <div class="divider">
                    <span>hoặc</span>
                </div>

                <div class="register-link">
                    <p>Chưa có tài khoản? <a href="user_regis.php">Đăng ký ngay</a></p>
                    <p><a href="#" onclick="showForgotPassword()">Quên mật khẩu?</a></p>
                </div>
            </div>
        </div>

        <!-- last child -->
        <?php include('../includes/footer.php'); ?>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous">
    </script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('user_password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function showForgotPassword() {
            alert('Tính năng quên mật khẩu sẽ được cập nhật trong thời gian tới!');
        }

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const username = document.getElementById('user_username').value.trim();
            const password = document.getElementById('user_password').value;

            if (username.length < 3) {
                e.preventDefault();
                alert('Tên đăng nhập phải có ít nhất 3 ký tự!');
                return;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Mật khẩu phải có ít nhất 6 ký tự!');
                return;
            }
        });

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                if (!alert.classList.contains('alert-success')) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            });
        }, 5000);
    </script>
</body>

</html>