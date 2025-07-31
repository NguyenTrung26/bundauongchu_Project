<div class="row">
    <div class="row formtitle mb">
        <h1>DANH SACH LOAI HANG </h1>
    </div>
    <form action="index.php?act=listsp" method="post">
                <input type="text" name="keyw">
                <select name="iddm">
                    <option value="0" selected>Tất cả</option>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="listok" value="OK">
            </form>
    <div class="row formcontent">
        <div class="row mb10 formdsloai">
            
            <table>
                <tr>
                    <th></th>
                    <th>MÃ SẢN PHẨM</th>
                    <th>TÊN SẢN PHẨM</th>
                    <th>HÌNH</th>
                    <th>GIÁ</th>
                    <th>LƯỢT XEM</th>
                    <th></th>
                </tr>
                <?php
                foreach ($listsanpham as $sanpham) {
                    extract($sanpham);
                    $suasp = "index.php?act=suasp&id=$id";
                    $xoasp = "index.php?act=xoasp&id=$id";
                    $imgpath = "upload/" . $img;
                    if(is_file($imgpath)){
                        $hinh = '<img src="'.$imgpath.'" width="100px" height="100px">';
                    }
                    else{
                        $hinh = "Không có hình";
                    }
                    echo '<tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>' . $id . '</td>
                            <td>' . $name . '</td>
                            <td>' . $hinh . '</td>
                            <td>' . $price . '</td>
                            <td>' . $view . '</td>
                            <td><a href="' . $suasp . '"><input type="button" value="Edit"></a> <a href="' . $xoasp . '"><input type="button" value="Delete"></a></td>
                        </tr>';
                }
                ?>
            </table>
        </div>
        <div class="row mb10">
            <input type="button" value="Chọn tất cả">
            <input type="button" value="Bỏ chọn tất cả">
            <input type="button" value="Xóa các mục đã chọn">
            <a href="index.php?act=addsp"><input type="button" value="Nhập thêm"></a>
        </div>
    </div>
</div>