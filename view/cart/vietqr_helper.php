<?php

class VietQRHelper {
    
    /**
     * Tạo VietQR Quick Link URL
     */
    public static function generateQRLink($orderId, $amount, $description = '') {
        // Chuẩn bị tham số
        $accountName = urlencode(VietQRConfig::BANK_NAME);
        $addInfo = urlencode($description ?: "Don hang CHN-$orderId");
        
        // Tạo URL theo format: https://api.vietqr.io/image/{BIN}-{ACCOUNT}-{TEMPLATE}.jpg
        $baseUrl = VietQRConfig::VIETQR_URL . '/' . 
                   VietQRConfig::BANK_BIN . '-' . 
                   VietQRConfig::BANK_ACCOUNT . '-' . 
                   VietQRConfig::TEMPLATE_CODE . '.jpg';
        
        // Thêm các tham số query
        $params = [
            'accountName' => VietQRConfig::BANK_NAME,
            'amount' => (int)$amount,
            'addInfo' => $description ?: "CHN-$orderId"
        ];
        
        return $baseUrl . '?' . http_build_query($params);
    }
    
    /**
     * Tạo thông tin QR để lưu
     */
    public static function createQRInfo($orderId, $amount, $description = '') {
        return [
            'qrImageURL' => self::generateQRLink($orderId, $amount, $description),
            'bankName' => self::getBankName(),
            'accountNo' => VietQRConfig::BANK_ACCOUNT,
            'accountName' => VietQRConfig::BANK_NAME,
            'amount' => (int)$amount,
            'addInfo' => $description ?: "CHN-$orderId",
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
    
    /**
     * Lưu thông tin QR vào session
     */
    public static function saveQRInfo($orderId, $qrData) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['qr_data_' . $orderId] = $qrData;
    }
    
    /**
     * Lấy thông tin QR từ session
     */
    public static function getQRInfo($orderId) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['qr_data_' . $orderId] ?? null;
    }
    
    /**
     * Lấy tên ngân hàng từ BIN
     */
    public static function getBankName() {
        return VietQRConfig::BANK_LIST[VietQRConfig::BANK_BIN] ?? 'Ngân hàng';
    }
    
    /**
     * Tạo QR ngay lập tức khi đặt hàng
     */
    public static function generateQRForOrder($orderId, $amount, $description = '') {
        $qrInfo = self::createQRInfo($orderId, $amount, $description);
        self::saveQRInfo($orderId, $qrInfo);
        return $qrInfo;
    }
}

// ==============================================
// FILE 3: bill_form_updated.php (Form đặt hàng đã cập nhật)
// ==============================================

?>