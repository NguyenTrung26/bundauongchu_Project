<div class="row">
    <div class="row formtitle mb">
        <h1>Danh sách đơn hang</h1>
    </div>
    <form action="index.php?act=listbill" method="post">
        <input type="text" name="kyw" placeholder="Nhập mã đơn hàng">
        <input type="submit" name="timkiem" value="Tìm kiếm">
    </form>
    <div class="row formcontent">
        <div class="row mb10 formdsloai">
            <table>
                <tr>
                    <th></th>
                    <th>MÃ ĐƠN HÀNG</th>
                    <th>KHÁCH HÀNG</th>
                    <th>SỐ LƯỢNG HÀNG</th>
                    <th>GIÁ TRỊ ĐƠN HÀNG</th>
                    <th>TÌNH TRẠNG ĐƠN HÀNG</th>
                    <th>NGÀY ĐẶT HÀNG</th>
                    <th>THAO TÁC</th>
                </tr>
                <?php
                foreach ($listbill as $bill) {
                    extract($bill);
                    $kh=$bill_name.'
                        <br>'.$bill_email.'
                        <br>'.$bill_addr.'
                        <br>'.$bill_phone;
                    $countsp=loadall_cart_count($id);
                    $ttdh=get_ttdh($bill_status);
                    echo '<tr>
                            <td><input type="checkbox"></td>
                            <td>CHN-' . $id . '</td>
                            <td>'.$kh.'</td>
                            <td>' . $countsp . '</td>
                            <td>' . $total . '</td>
                            <td>' . $ttdh . '</td>
                            <td>' . $ngaydathang . '</td>
                            <td><input type="button" value="Sửa"><input type="button" value="Xóa"></td>
                        </tr>';
                }
                ?>
            </table>
        </div>
        <div class="row mb10">
            <input type="button" value="Chọn tất cả">
            <input type="button" value="Bỏ chọn tất cả">
            <input type="button" value="Xóa mục đã chọn">
            <a href="index.php?act=addsp"><input type="button" value="Nhập thêm"></a>
        </div>
    </div>
</div>