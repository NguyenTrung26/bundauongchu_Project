<div class="row">
    <div class="row formtitle">
        <h1>THEM MOI SAN PHAM</h1>
    </div>
    <div class="row formcontent">
        <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">
            <div class="row mb10">
                Danh muc<br>
                <select name="iddm">
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                    ?>
                </select>

            </div>
            <div class="row mb10">
                Tên sản phẩm<br>
                <input type="text" name="name">
            </div>
            <div class="row mb10">
                Giá<br>
                <input type="text" name="price">
            </div>
            <div class="row mb10">
                Hình<br>
                <input type="file" name="img">
            </div>
            <div class="row mb10">
                Mô tả<br>
                <textarea name="describe" cols="30" rows="10"></textarea>
            </div>
            <div class="row mb10">
                <input type="submit" name="themmoi" value="Thêm mới">
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