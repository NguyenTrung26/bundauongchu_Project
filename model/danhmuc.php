<?php

function danhmuc_insert($tenloai)
{
    $sql = "INSERT INTO danhmuc(name) VALUES('$tenloai')";
    pdo_execute($sql);
}

function danhmuc_delete($id)
{
    $sql = "DELETE FROM danhmuc WHERE id=" . $id;
    pdo_execute($sql);
}

function danhmuc_loadall()
{
    $sql = "SELECT * FROM danhmuc order by id desc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

function danhmuc_loadone($id)
{
    $sql = "SELECT * FROM danhmuc WHERE id=" .$id;
    $danhmuc = pdo_query_one($sql);
    return $danhmuc;
}

function danhmuc_update($id, $tenloai)
{
    $sql = "UPDATE danhmuc SET name='$tenloai' WHERE id=".$id;
    pdo_execute($sql);
}
?>