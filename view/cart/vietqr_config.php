<?php
class VietQRConfig {
    const BANK_BIN = '970422';           // Mã BIN ngân hàng
    const BANK_ACCOUNT = '999920048686'; // Số tài khoản
    const BANK_NAME = 'NGUYEN TRUNG';    // Tên tài khoản
    const TEMPLATE_CODE = 'FQwPNyv';     // Template code
    const VIETQR_URL = 'https://api.vietqr.io/image';
    
    const BANK_LIST = [
        '970422' => 'MBBank',
        '970436' => 'Vietcombank',
        '970415' => 'VietinBank'
        // ... thêm các ngân hàng khác
    ];
}
?>