<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'model/pdo.php';
require_once 'model/cart.php';
require_once 'model/discount.php';

// Xử lý áp mã giảm giá
$message = "";
if (isset($_POST['apply_discount'])) {
    $code = trim($_POST['discount_code']);
    $discount = checkDiscountCode($code);

    if ($discount) {
        $_SESSION['discount_percent'] = $discount['discount_percent'];
        $_SESSION['discount_code'] = $discount['code'];
        $message = "<p style='color:green'>Áp dụng mã giảm giá thành công: -{$discount['discount_percent']}%</p>";
    } else {
        unset($_SESSION['discount_percent']);
        unset($_SESSION['discount_code']);
        $message = "<p style='color:red'>Mã giảm giá không hợp lệ hoặc đã hết hạn!</p>";
    }
}
?>

<div class="row mb">
    <style>
        input[type="text"],
        input[type="number"],
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }

        .bill a input[type="button"] {
            width: auto;
            display: inline-block;
            margin-right: 10px;
        }

        .discount-box {
            margin-top: 10px;
            padding: 10px;
            border: 1px dashed #aaa;
            background: #f9f9f9;
        }
    </style>

    <div class="boxtrai mr">
        <form action="index.php?act=billconfirm" method="post">
            <!-- Thông tin khách hàng -->
            <div class="row mb">
                <div class="boxtitle">Thông tin đặt hàng</div>
                <div class="row boxcontent billconfirm">
                    <table>
                        <?php
                        if (isset($_SESSION['user'])) {
                            $name = $_SESSION['user']['user'];
                            $addr = $_SESSION['user']['addr'];
                            $phone = $_SESSION['user']['phone'];
                            $email = $_SESSION['user']['email'];
                        } else {
                            $name = $addr = $phone = $email = "";
                        }
                        ?>
                        <tr>
                            <td>Họ tên</td>
                            <td><input type="text" name="user" value="<?= $name ?>"></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td><input type="text" name="addr" value="<?= $addr ?>"></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><input type="text" name="phone" value="<?= $phone ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" value="<?= $email ?>"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="row mb">
                <div class="boxtitle">PHƯƠNG THỨC THANH TOÁN</div>
                <div class="row boxcontent">
                    <table>
                        <tr>
                            <td><input type="radio" name="pttt" value="1" checked> Thanh toán khi nhận hàng</td>
                            <td><input type="radio" name="pttt" value="2"> Chuyển khoản ngân hàng</td>
                            <td><input type="radio" name="pttt" value="3"> Thanh toán online</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Giỏ hàng -->
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN GIỎ HÀNG</div>
                <div class="row boxcontent cart">
                    <table>
                        <?php
                        $tong = viewcart(0);

                        // Áp dụng mã giảm giá nếu có
                        $discount_percent = $_SESSION['discount_percent'] ?? 0;
                        if ($discount_percent > 0) {
                            $giamgia = $tong * $discount_percent / 100;
                            $tong -= $giamgia;
                            echo "<tr><td colspan='3'>Giảm giá ({$discount_percent}%)</td><td>-" . number_format($giamgia, 0, ",", ".") . "đ</td></tr>";
                        }

                        echo "<tr><td colspan='3'><strong>Tổng đơn hàng</strong></td><td><strong>" . number_format($tong, 0, ",", ".") . "đ</strong></td></tr>";
                        ?>
                    </table>
                </div>
            </div>

            <!-- Nhập mã giảm giá -->
            <div class="row mb discount-box">
                <label for="discount_code">Mã giảm giá:</label>
                <input type="text" name="discount_code" placeholder="Nhập mã giảm giá">
                <input type="submit" name="apply_discount" value="Áp dụng" formaction="">
                <?= $message ?>
            </div>

            <!-- Nút đặt hàng -->
            <div class="row mb bill">
                <input type="hidden" name="tongdonhang" value="<?= $tong ?>">
                <input type="submit" value="ĐỒNG Ý ĐẶT HÀNG" name="dongydathang">
            </div>
        </form>
    </div>

    <div class="boxphai">
        <?php include 'view/boxright.php'; ?>
    </div>
</div>
