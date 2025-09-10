<?php if (isset($bill) && is_array($bill)) { extract($bill); } ?>

<div class="row">
    <div class="row mb">
        <div class="boxtrai mr">

            <div class="row mb">
                <div class="boxtitle">Cám ơn</div>
                <div class="row boxcontent" style="text-align:center;">
                    <h2>Cảm ơn bạn đã đặt hàng!</h2>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
                    <a href="index.php"><input type="button" value="Quay lại trang chủ"></a>
                </div>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN ĐƠN HÀNG</div>
                <div class="row boxcontent" style="line-height:1.8;">
                    <li><b>Mã đơn hàng:</b> CHN-<?= $bill['id'] ?></li>
                    <li><b>Ngày đặt hàng:</b> <?= $bill['ngaydathang'] ?></li>
                    <li><b>Tổng đơn hàng (gốc):</b> <?= number_format($bill['total'], 0, ",", ".") ?> VNĐ</li>

                    <?php if ($bill['discount_percent'] > 0) { ?>
                        <li><b>Mã giảm giá:</b> <?= $bill['discount_code'] ?> (<?= $bill['discount_percent'] ?>%)</li>
                        <li><b>Giảm giá:</b> -<?= number_format(($bill['total'] * $bill['discount_percent']) / 100, 0, ",", ".") ?> VNĐ</li>
                        <li><b>Thành tiền cuối cùng:</b> <span style="color:red; font-weight:bold;">
                            <?= number_format($bill['total_final'], 0, ",", ".") ?> VNĐ
                        </span></li>
                    <?php } else { ?>
                        <li><b>Thành tiền:</b> <span style="color:red; font-weight:bold;">
                            <?= number_format($bill['total'], 0, ",", ".") ?> VNĐ
                        </span></li>
                    <?php } ?>

                    <li><b>Phương thức thanh toán:</b> 
                        <?= ($bill['bill_pttt']==1) ? "Thanh toán khi nhận hàng" : (($bill['bill_pttt']==2) ? "Chuyển khoản ngân hàng" : "Thanh toán online") ?>
                    </li>

                    <!-- Nếu chọn Chuyển khoản thì hiển thị nút MoMo -->
                    <?php if ($bill['bill_pttt']==2) { ?>
                        <div style="margin-top:15px;">
                            <a href="momo_qr.php?orderId=<?= $bill['id'] ?>&amount=<?= ($bill['total_final']>0) ? $bill['total_final'] : $bill['total'] ?>" target="_blank">
                                <button style="background:#a50064;color:#fff;padding:12px 20px;border:none;border-radius:8px;cursor:pointer;font-size:16px;">
                                    💳 Thanh toán bằng MoMo QR
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Thông tin khách hàng -->
            <div class="row mb">
                <div class="boxtitle">THÔNG TIN KHÁCH HÀNG</div>
                <div class="row boxcontent">
                    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
                        <tr><td><b>Họ tên</b></td><td><?= $bill['bill_name'] ?></td></tr>
                        <tr><td><b>Địa chỉ</b></td><td><?= $bill['bill_addr'] ?></td></tr>
                        <tr><td><b>Điện thoại</b></td><td><?= $bill['bill_phone'] ?></td></tr>
                        <tr><td><b>Email</b></td><td><?= $bill['bill_email'] ?></td></tr>
                    </table>
                </div>
            </div>

            <!-- Chi tiết giỏ hàng -->
            <div class="row mb">
                <div class="boxtitle">CHI TIẾT GIỎ HÀNG</div>
                <div class="row boxcontent cart">
                    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
                        <?php bill_chi_tiet($billct); ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="boxphai">
            <?php include "view/boxright.php"; ?>
        </div>
    </div>
</div>
