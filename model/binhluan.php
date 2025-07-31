<?php
    function insert_binhluan($noidung, $idpro, $iduser,$ngaybinhluan){
        $sql = "INSERT INTO binhluan (noidung, iduser, idpro, ngaybinhluan) VALUES ('$noidung', '$iduser', '$idpro', '$ngaybinhluan')";
        pdo_query($sql);
    }

    function loadall_binhluan($idpro){
        $sql = "SELECT * FROM binhluan where 1";
        if($idpro > 0) $sql.=" AND idpro= '".$idpro."'";
        $sql.=" ORDER BY ngaybinhluan DESC";
        $listbl = pdo_query($sql);
        return $listbl;
    }
?>