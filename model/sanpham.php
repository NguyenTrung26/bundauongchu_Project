<?php
function sanpham_insert($name, $price, $describe, $img, $iddm) {
    $sql = "INSERT INTO sanpham (name, price, `describe`, img, iddm) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $price, $describe, $img, $iddm);
}
function sanpham_delete($id){
    $sql = "DELETE FROM sanpham WHERE id=" . $id;
    pdo_execute($sql);
}
function sanpham_loadall_top10(){
    $sql = "SELECT * FROM sanpham WHERE 1 ORDER BY view DESC LIMIT 9";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function sanpham_loadall_home(){
    $sql = "SELECT * FROM sanpham WHERE 1 ORDER BY id DESC LIMIT 9";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function sanpham_loadall($keyw="", $iddm=0){
    $sql = "SELECT * FROM sanpham WHERE 1";
    if($keyw!=""){
        $sql .= " AND name LIKE '%$keyw%'";
    }
    if($iddm > 0){
        $sql .= " AND iddm=$iddm";
    }
    $sql .= " ORDER BY id DESC";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function load_ten_danhmuc($iddm){
    if($iddm>0){
    $sql = "SELECT * FROM danhmuc WHERE id=" .$iddm;
    $dm = pdo_query_one($sql);
    extract($dm);
    return $name;
    }else{
        return "";
    }
}
function sanpham_loadone($id){
    $sql = "SELECT * FROM sanpham WHERE id=" .$id;
    $sp = pdo_query_one($sql);
    return $sp;
}
function sanpham_load_cungloai($id, $iddm){
    $sql = "SELECT * FROM sanpham WHERE iddm='.$iddm.' AND id <>" .$id;
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
function sanpham_update($id, $name, $price, $describe, $img, $iddm){
    if($img==""){
        $sql = "UPDATE sanpham SET name='$name', price='$price', `describe`='$describe', iddm='$iddm' WHERE id=".$id;
    }else{
        $sql = "UPDATE sanpham SET name='$name', price='$price', `describe`='$describe', img='$img', iddm='$iddm' WHERE id=".$id;
    }
    pdo_execute($sql);
}

?>