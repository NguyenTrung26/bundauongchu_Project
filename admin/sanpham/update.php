<?php
    if(is_array($sanpham)){
        $productName = $sanpham['name'];
        $productPrice = $sanpham['price'];
        $productImg = $sanpham['img'];
        $productDescribe = $sanpham['describe'];
        $productId = $sanpham['id'];
        $productIddm = $sanpham['iddm'];
    }

    $imgpath = "upload/" . $productImg;
    if(is_file($imgpath)){
        $hinh = '<img src="'.$imgpath.'" width="100px" height="100px">';
    }
    else{
        $hinh = "Không có hình";
    }
?>
<div class="row">
    <div class="row formtitle">
        <h1>CẬP NHẬT SẢN PHẨM</h1>
    </div>
    <div class="row formcontent">
        <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
            <div class="row mb10">
                <select name="iddm">
                    <option value="0" selected>Tất cả</option>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        $selected = ($productIddm == $id) ? "selected" : "";
                        echo '<option value="' . $id . '" '.$selected.'>' . $name . '</option>'; 
                    }
                    ?>
                </select>
            </div>
            <div class="row mb10">
                Tên sản phẩm<br>
                <input type="text" name="tensp" value="<?=$productName?>">
            </div>
            <div class="row mb10">
                Giá<br>
                <input type="text" name="giasp" value="<?=$productPrice?>">
            </div>
            <div class="row mb10">
                Hình<br>
                <input type="file" name="hinhsp">
                <?=$hinh?>
            </div>
            <div class="row mb10">
                Mô tả<br>
                <textarea name="motasp" id="" cols="30" rows="10"><?=$productDescribe?></textarea>
            </div>
            <div class="row mb10">
                <input type="hidden" name="id" value="<?=$productId?>">
                <input type="submit" name="capnhat" value="Cập nhật">
                <input type="reset" value="Nhập lại">
                <a href="index.php?act=listsp"><input type="button" value="Danh sách"></a>
            </div>
            <?php
            if (isset($thongbao) && ($thongbao != "")) {
                echo $thongbao;
            }
            ?>
        </form>
    </div>
</div>
</div>