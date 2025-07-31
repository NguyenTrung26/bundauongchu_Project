<div class="row">
    <div class="row mb">
        <div class="boxtrai mr">
            <div class="row mb">
                <div class="boxtitle">Cám ơn</div>
                <div class="row boxcontent" style="text-align: center;">
                    <h2>Cảm ơn bạn đã đặt hàng</h2>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
                    <a href="index.php"><input type="button" value="Quay lại trang chủ"></a>
                </div>
            </div>
            <?php
            if (isset($bill) && (is_array($bill))) {
                extract($bill);
            }
            ?>
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN ĐƠN HÀNG</div>
                <div class="row boxcontent" style="text-align: center;">
                    <li>Mã đơn hàng: CHN-<?= $bill['id']; ?></li>
                    <li>Ngày đặt hàng: <?= $bill['ngaydathang']; ?></li>
                    <li>Tổng đơn hàng: <?= $bill['total']; ?></li>
                    <li>Phương thức thanh toán: <?= $bill['bill_pttt']; ?></li>
                </div>
            </div>
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN ĐƠN HÀNG</div>
                <div class="row boxcontent">
                    <table>
                        <tr>
                            <td>Họ tên</td>
                            <td><?= $bill['bill_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td><?= $bill['bill_addr']; ?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><?= $bill['bill_phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $bill['bill_email']; ?></td>
                        </tr>
                        <tr>
                            <td>Phương thức thanh toán</td>
                            <td><?= $bill['bill_pttt']; ?></td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="row mb">
                <div class="boxtitle">CHI TIẾT GIỎ HÀNG</div>
                <div class="row boxcontent cart">
                    <table>
                        <?php
                        bill_chi_tiet($billct);
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="boxphai">
            <?php include 'view/boxright.php'; ?>
        </div>
    </div>
</div>