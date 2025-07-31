<div class="row">
    <div class="row formtitle">
        <h1>DANH SACH TÀI KHOẢN </h1>
    </div>
    <div class="row formcontent">
        <div class="row mb10 formdsloai">
            <table>
                <tr>
                    <th></th>
                    <th>MÃ TK</th>
                    <th>TÊN ĐĂNG NHẬP</th>
                    <th>MẬT KHẨU</th>
                    <th>EMAIL</th>
                    <th>ĐỊA CHỈ</th>
                    <th>ĐIỆN THOẠI</th>
                    <th>VAI TRÒ</th>
                    <th></th>
                </tr>
                <?php
                foreach ($listtaikhoan as $tk) {
                    extract($tk);
                    echo '<tr>
                            <td><input type="checkbox" name=""></td>
                            <td>' . $id . '</td>
                            <td>' . $user . '</td>
                            <td>' . $pass . '</td>
                            <td>' . $email . '</td>
                            <td>' . $addr . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $role . '</td>
                            <td>
                                <a href="index.php?act=suatk&id=' . $id . '"><input type="button" value="Sửa"></a>
                                <a href="index.php?act=xoatk&id=' . $id . '"><input type="button" value="Xóa"></a>
                            </td>
                        </tr>';
                } 
                ?>
            </table>
        </div>
        <div class="row mb10">
            <input type="button" value="Chọn tất cả">
            <input type="button" value="Bỏ chọn tất cả">
            <input type="button" value="Xóa các mục đã chọn">
            <a href="index.php?act=adddm"><input type="button" value="Nhập thêm"></a>
        </div>
    </div>
</div>