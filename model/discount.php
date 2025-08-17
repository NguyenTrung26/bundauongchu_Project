<?php
function createDiscount($percent) {
    $code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
    $sql = "INSERT INTO discount (discount_percent, code, is_used) VALUES (?, ?, 0)";
    pdo_execute($sql, $percent, $code);
    return $code;
}

function getAllDiscounts() {
    $sql = "SELECT * FROM discount ORDER BY id DESC";
    return pdo_query($sql);
}

function checkDiscountCode($code) {
    $sql = "SELECT * FROM discount WHERE code = ? AND is_used = 0";
    $discount = pdo_query_one($sql, $code);
    return $discount ? $discount : false;
}

function markDiscountUsed($code) {
    $sql = "UPDATE discount SET is_used = 1 WHERE code = ?";
    pdo_execute($sql, $code);
}
?>
