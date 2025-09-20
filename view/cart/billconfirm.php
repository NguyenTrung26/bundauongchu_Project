
<?php 
include "view/cart/vietqr_helper.php";
include "view/cart/vietqr_config.php";
if (isset($bill) && is_array($bill)) { 
    extract($bill); 
    
    // Lấy thông tin QR nếu có
    $qrInfo = null;
    if ($bill['bill_pttt'] == 2) {
        $qrInfo = VietQRHelper::getQRInfo($bill['id']);
    }
} 
?>

<div class="row">
    <div class="row mb">
        <div class="boxtrai mr">

            <div class="row mb">
                <div class="boxtitle">🎉 Cám ơn</div>
                <div class="row boxcontent" style="text-align:center;">
                    <h2>Cảm ơn bạn đã đặt hàng!</h2>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
                    <?php if ($bill['bill_pttt'] == 2): ?>
                        <p style="color:#e74c3c; font-weight:bold;">
                            ⚠️ Vui lòng thanh toán để xác nhận đơn hàng
                        </p>
                    <?php endif; ?>
                    <a href="index.php"><input type="button" value="🏠 Quay lại trang chủ"></a>
                </div>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="row mb">
                <div class="boxtitle">📋 THÔNG TIN ĐƠN HÀNG</div>
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
                        <?php 
                        if ($bill['bill_pttt'] == 1) echo "💵 Thanh toán khi nhận hàng";
                        elseif ($bill['bill_pttt'] == 2) echo "🏦 Chuyển khoản ngân hàng (VietQR)";
                        else echo "💳 Thanh toán online";
                        ?>
                    </li>
                </div>
            </div>

            <!-- Hiển thị VietQR nếu chọn chuyển khoản -->
            <?php if ($bill['bill_pttt'] == 2): ?>
                <div class="row mb">
                    <div class="boxtitle">💳 THANH TOÁN VIETQR</div>
                    <div class="row boxcontent">
                        <?php if ($qrInfo): ?>
                            <!-- Debug info (có thể xóa sau khi test) -->
                            <!-- 
                            <div style="background:#f0f0f0; padding:10px; margin-bottom:15px; font-size:12px;">
                                <strong>Debug QR Info:</strong><br>
                                URL: <?= $qrInfo['qrImageURL'] ?><br>
                                Amount: <?= $qrInfo['amount'] ?><br>
                                AddInfo: <?= $qrInfo['addInfo'] ?>
                            </div>
                            -->
                            
                            <div style="display:flex; gap:30px; align-items:flex-start; flex-wrap:wrap;">
                                <!-- Mã QR -->
                                <div style="text-align:center;">
                                    <div style="border:3px solid #27ae60; padding:15px; border-radius:12px; background:#fff; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
                                        <img src="<?= $qrInfo['qrImageURL'] ?>" alt="VietQR Code" style="width:300px; height:auto; border-radius:8px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div style="display:none; color:red; padding:20px;">
                                            ❌ Không thể tải ảnh QR<br>
                                            <small>URL: <?= $qrInfo['qrImageURL'] ?></small>
                                        </div>
                                        <p style="margin:10px 0 5px 0; font-weight:bold; color:#27ae60;">📱 Quét mã để thanh toán</p>
                                        <p style="margin:0; font-size:12px; color:#666;">Sử dụng app ngân hàng hoặc ví điện tử</p>
                                    </div>
                                </div>
                                
                                <!-- Thông tin chuyển khoản -->
                                <div style="flex:1; min-width:300px;">
                                    <div style="background:#f8f9fa; padding:20px; border-radius:8px; border-left:4px solid #27ae60;">
                                        <h3 style="color:#27ae60; margin-top:0;">🏦 Thông tin chuyển khoản</h3>
                                        <table style="width:100%; line-height:2;">
                                            <tr><td><b>🏦 Ngân hàng:</b></td><td><?= $qrInfo['bankName'] ?></td></tr>
                                            <tr><td><b>📱 Số tài khoản:</b></td><td><?= $qrInfo['accountNo'] ?></td></tr>
                                            <tr><td><b>👤 Tên tài khoản:</b></td><td><?= $qrInfo['accountName'] ?></td></tr>
                                            <tr><td><b>💰 Số tiền:</b></td><td style="color:red; font-weight:bold;">
                                                <?= number_format($qrInfo['amount'], 0, ",", ".") ?> VNĐ
                                            </td></tr>
                                            <tr><td><b>📝 Nội dung:</b></td><td><?= $qrInfo['addInfo'] ?></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hướng dẫn -->
                            <div style="margin-top:25px; padding:20px; background:#e8f5e8; border-radius:8px; border:1px solid #27ae60;">
                                <h4 style="color:#27ae60; margin-top:0;">📋 Hướng dẫn thanh toán</h4>
                                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:15px;">
                                    <div>
                                        <h5>📱 Cách 1: Quét QR Code</h5>
                                        <ol style="margin:0; padding-left:20px; font-size:14px;">
                                            <li>Mở app ngân hàng trên điện thoại</li>
                                            <li>Chọn "Chuyển khoản" → "Quét QR"</li>
                                            <li>Quét mã QR ở bên trái</li>
                                            <li>Kiểm tra thông tin và xác nhận</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <h5>⌨️ Cách 2: Chuyển khoản thủ công</h5>
                                        <ol style="margin:0; padding-left:20px; font-size:14px;">
                                            <li>Mở app ngân hàng</li>
                                            <li>Chọn "Chuyển khoản"</li>
                                            <li>Nhập thông tin bên trên</li>
                                            <li>Xác nhận và hoàn tất</li>
                                        </ol>
                                    </div>
                                </div>
                                <div style="margin-top:15px; padding:10px; background:#fff3cd; border-radius:5px; border:1px solid #ffc107;">
                                    <p style="margin:0; color:#856404; font-size:14px;">
                                        <b>⚠️ Lưu ý:</b> Vui lòng chuyển khoản đúng số tiền và nội dung để đơn hàng được xử lý nhanh chóng.
                                    </p>
                                </div>
                            </div>
                            
                        <?php else: ?>
                            <!-- Tạo QR trực tiếp nếu không có -->
                            <?php
                            // Backup: tạo QR trực tiếp bằng URL
                            $finalAmount = ($bill['total_final'] > 0) ? $bill['total_final'] : $bill['total'];
                            $qrURL = VietQRHelper::generateQRLink(
                                $bill['id'], 
                                $finalAmount, 
                                "Thanh toan don hang CHN-" . $bill['id']
                            );
                            ?>
                            <div style="display:flex; gap:30px; align-items:flex-start; flex-wrap:wrap;">
                                <!-- Mã QR -->
                                <div style="text-align:center;">
                                    <div style="border:3px solid #27ae60; padding:15px; border-radius:12px; background:#fff; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
                                        <img src="<?= $qrURL ?>" alt="VietQR Code" style="width:300px; height:auto; border-radius:8px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div style="display:none; color:red; padding:20px;">
                                            ❌ Không thể tải ảnh QR<br>
                                            <small>Vui lòng kiểm tra cấu hình VietQR</small>
                                        </div>
                                        <p style="margin:10px 0 5px 0; font-weight:bold; color:#27ae60;">📱 Quét mã để thanh toán</p>
                                        <p style="margin:0; font-size:12px; color:#666;">Sử dụng app ngân hàng hoặc ví điện tử</p>
                                    </div>
                                </div>
                                
                                <!-- Thông tin chuyển khoản -->
                                <div style="flex:1; min-width:300px;">
                                    <div style="background:#f8f9fa; padding:20px; border-radius:8px; border-left:4px solid #27ae60;">
                                        <h3 style="color:#27ae60; margin-top:0;">🏦 Thông tin chuyển khoản</h3>
                                        <table style="width:100%; line-height:2;">
                                            <tr><td><b>🏦 Ngân hàng:</b></td><td><?= VietQRHelper::getBankName() ?></td></tr>
                                            <tr><td><b>📱 Số tài khoản:</b></td><td><?= VietQRConfig::BANK_ACCOUNT ?></td></tr>
                                            <tr><td><b>👤 Tên tài khoản:</b></td><td><?= VietQRConfig::BANK_NAME ?></td></tr>
                                            <tr><td><b>💰 Số tiền:</b></td><td style="color:red; font-weight:bold;">
                                                <?= number_format($finalAmount, 0, ",", ".") ?> VNĐ
                                            </td></tr>
                                            <tr><td><b>📝 Nội dung:</b></td><td>CHN-<?= $bill['id'] ?></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Thông tin khách hàng -->
            <div class="row mb">
                <div class="boxtitle">👤 THÔNG TIN KHÁCH HÀNG</div>
                <div class="row boxcontent">
                    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
                        <tr><td><b>👤 Họ tên</b></td><td><?= $bill['bill_name'] ?></td></tr>
                        <tr><td><b>🏠 Địa chỉ</b></td><td><?= $bill['bill_addr'] ?></td></tr>
                        <tr><td><b>📞 Điện thoại</b></td><td><?= $bill['bill_phone'] ?></td></tr>
                        <tr><td><b>📧 Email</b></td><td><?= $bill['bill_email'] ?></td></tr>
                    </table>
                </div>
            </div>

            <!-- Chi tiết giỏ hàng -->
            <div class="row mb">
                <div class="boxtitle">🛒 CHI TIẾT GIỎ HÀNG</div>
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

<style>
/* Responsive styles */
@media (max-width: 768px) {
    div[style*="display:flex"] {
        flex-direction: column !important;
    }
    
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<script src="../script/main.js"></script>