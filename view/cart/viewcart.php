<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="view/cart/style.css">
</head>
<body>
    <div class="row mb">
        <div class="boxtrai mr">
            <div class="row mb">
                <div class="boxtitle">Giỏ hàng</div>
                <div class="row boxcontent cart">
                    <table>
                        <?php
                        if (isset($_SESSION['mycart'])) {
                            viewcart(1);
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="row mb bill">
                <a href="index.php?act=bill"><input type="button" value="TIẾP TỤC ĐẶT HÀNG"></a>
                <a href="index.php?act=delcart"><input type="button" value="XÓA GIỎ HÀNG"></a>
            </div>
        </div>
        <div class="boxphai">
            <?php include 'view/boxright.php'; ?>
        </div>
    </div>
</body>
</html>