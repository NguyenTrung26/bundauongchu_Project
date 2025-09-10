<div class="row mb ">
    <div class="boxcontent formtaikhoan">
        <?php
        if (isset($_SESSION['user'])) {
            extract($_SESSION['user']);
        ?>

            <div class="row mb10">
                Xin chao<br>
                <?= $user ?>
            </div>
            <div class="row mb10">
                <li>
                    <a href="index.php?act=mybill">Đơn hàng của tôi</a>
                </li>
                <li>
                    <a href="index.php?act=quenmk">Quên mật khẩu</a>
                </li>
                <li>
                    <a href="index.php?act=edit_taikhoan">Cập nhật tài khoản</a>
                </li>
                <?php
                if ($role == 1) {
                ?>
                    <li>
                        <a href="admin/index.php">Đăng nhập Admin</a>
                    </li>
                <?php
                }
                ?>
                <li>
                    <a href="index.php?act=thoat">Thoát</a>
                </li>
            </div>
        <?php
        } else {
        ?>
            <form action="index.php?act=dangnhap" method="post">
                <div class="row mb10">
                    Tên đăng nhập<br>
                    <input type="text" name="user" placeholder="Username">
                </div>
                <div class="row mb10">
                    Mật khẩu<br>
                    <input type="password" name="pass" placeholder="Password">
                </div>
                <div class="row mb10">
                    <input type="checkbox" name="">Ghi nhớ tài khoản<br>
                </div>
                <div class="row mb10">
                    <input type="submit" value="Đăng nhập" name="dangnhap">
                </div>
            </form>
            <li>
                <a href="#">Quên mật khẩu</a>
            </li>
            <li>
                <a href="index.php?act=dangky">Đăng ký</a>
            </li>
        <?php
        }
        ?>
    </div>
</div>
<div class="row mb">
    <div class="boxtitle">DANH MUC</div>
    <div class="boxcontent2 menudoc">
        <ul>
            <?php
            foreach ($dmsp as $dm) {
                extract($dm);
                echo '<li>
                            <a href="index.php?act=sanpham&iddm=' . $id . '">' . $name . '</a>
                        </li>';
            }
            ?>
            
        </ul>
    </div>
    <div class="boxfooter searchbox">
        <form action="index.php?act=sanpham" method="post">
            <input type="text" name="kyw" placeholder="Tìm kiếm">
            <input type="submit" name="timkiem" value="Tìm">

        </form>
    </div>
</div>
<div class="row">
    <div class="boxtitle">TOP 10 YEU THICH</div>
    <div class=" row boxcontent">
        <?php
        foreach ($dstop10 as $sp) {
            extract($sp);
            echo '<div class="row mb10 top10">
                        <a href="index.php?act=sanphamct&idsp=' . $id . '"><img src="view/images/' . $img . '" alt=""></a>
                        <a href="index.php?act=sanphamct&idsp=' . $id . '">' . $name . '</a>
                    </div>';
        }
        ?>
        <!-- <div class="row mb10 top10">
                    <img src="view/images/1.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/2.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/3.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/4.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/5.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/6.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/7.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/8.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/9.jpg" alt="">
                    <a href="">Q&Q</a>
                </div>
                <div class="row mb10 top10">
                    <img src="view/images/1.jpg" alt="">
                    <a href="">Q&Q</a>
                </div> -->
    </div>
</div>