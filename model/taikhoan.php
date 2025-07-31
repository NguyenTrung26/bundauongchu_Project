<?php
function taikhoan_insert($email, $user, $pass) {
    $sql = "INSERT INTO taikhoan (email, user, pass) VALUES ('$email', '$user', '$pass')";
    pdo_execute($sql);
}

function checkuser($user, $pass) {
    $sql = "SELECT * FROM taikhoan WHERE user='$user' AND pass='$pass'";
    $tk = pdo_query_one($sql);
    return $tk;
}
function taikhoan_update($id, $user, $pass, $email, $addr, $phone){
    $sql = "UPDATE taikhoan SET user='$user', pass='$pass', email='$email', addr='$addr', phone='$phone' WHERE id=".$id;
    pdo_execute($sql);
}
function quenmk($email) {
    $sql = "SELECT * FROM taikhoan WHERE email='$email'";
    $tk = pdo_query_one($sql);
    return $tk;
}
function taikhoan_loadall()
{
    $sql = "SELECT * FROM taikhoan";
    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}
?>