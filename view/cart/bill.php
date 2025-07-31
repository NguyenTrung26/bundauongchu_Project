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
    </style>
    <div class="boxtrai mr">
        <form action="index.php?act=billconfirm" method="post">
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
                            $name = "";
                            $addr = "";
                            $phone = "";
                            $email = "";
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
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN GIỎ HÀNG</div>
                <div class="row boxcontent cart">
                    <table>
                        <?php viewcart(0); ?>
                    </table>
                </div>
            </div>
            <div class="row mb bill">
                <input type="submit" value="ĐỒNG Ý ĐẶT HÀNG" name="dongydathang">
            </div>
        </form>
    </div>
    <div class="boxphai">
        <?php include 'view/boxright.php'; ?>
    </div>
</div>