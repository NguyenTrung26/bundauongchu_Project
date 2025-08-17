<?php
function viewcart($del)
{
    $tongtien = 0;
    $i = 0;
    $xoasp_th = $del == 1 ? '<th>Thao tác</th>' : '';
    $xoasp_td2 = '';

    echo '<table>';
    echo '<tr>
            <th>Hình</th>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            ' . $xoasp_th . '
        </tr>';

    foreach ($_SESSION['mycart'] as $cart) {
        $img = htmlspecialchars($cart[2]);
        $price = htmlspecialchars($cart[3]);
        $qty = htmlspecialchars($cart[4]);
        $thanhtien = htmlspecialchars($cart[5]);
        $tongtien += $thanhtien;

        $xoasp_td = $del == 1 
            ? '<td><a href="index.php?act=delcart&idcart=' . $i . '"><button type="button">Xóa</button></a></td>' 
            : '<td></td>';

        echo '<tr>
                <td><img src="view/images/' . $img . '" alt="" width="80"></td>
                <td>' . htmlspecialchars($cart[1]) . '</td>
                <td>' . $price . '</td>
                <td><input type="number" value="' . $qty . '" min="1" max="10"></td>
                <td>' . $thanhtien . '</td>
                ' . $xoasp_td . '
            </tr>';
        $i++;
    }

    // --- Tổng tiền gốc ---
    echo '<tr>
            <td colspan="4">Tổng tiền</td>
            <td>' . $tongtien . '</td>
            ' . $xoasp_td2 . '
        </tr>';

    // --- Nếu có mã giảm giá ---
    if (isset($_SESSION['discount_percent']) && $_SESSION['discount_percent'] > 0) {
        $discount_percent = $_SESSION['discount_percent'];
        $discount_amount = $tongtien * $discount_percent / 100;
        $total_final = $tongtien - $discount_amount;

        echo '<tr>
                <td colspan="4">Giảm giá (' . $discount_percent . '%)</td>
                <td>-' . $discount_amount . '</td>
            </tr>';
        echo '<tr>
                <td colspan="4"><b>Thành tiền sau giảm</b></td>
                <td><b>' . $total_final . '</b></td>
            </tr>';
    }

    echo '</table>';
}

function bill_chi_tiet($listbill)
{
    $tongtien = 0;
    $i = 0;
    echo '<table>';
    echo '<tr>
            <th>Hình</th>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>';

    foreach ($listbill as $cart) {
        $img = htmlspecialchars($cart['img']);
        $tongtien += htmlspecialchars($cart['thanhtien']);

        echo '<tr>
                <td><img src="view/images/' . $img . '" alt=""></td>
                <td>' . htmlspecialchars($cart['name']) . '</td>
                <td>' . htmlspecialchars($cart['price']) . '</td>
                <td><input type="number" value="' . htmlspecialchars($cart['soluong']) . '" min="1" max="10"></td>
                <td>' . htmlspecialchars($cart['thanhtien']) . '</td>
            </tr>';
        $i++;
    }

    echo '<tr>
            <td colspan="4">Tổng tiền</td>
            <td>' . $tongtien . '</td>
        </tr>';
    echo '</table>';
}

function tongdonhang()
{
    $tongtien = 0;

    foreach ($_SESSION['mycart'] as $cart) {
        $thanhtien = htmlspecialchars($cart[5]);
        $tongtien += $thanhtien;
    }
    return $tongtien;
}

function insert_bill($iduser, $name, $addr, $phone, $email, $pttt, $ngaydathang, $total, $discount_code, $discount_percent, $total_final) {
    $sql = "INSERT INTO bill(iduser, bill_name, bill_addr, bill_phone, bill_email, bill_pttt, ngaydathang, total, discount_code, discount_percent, total_final) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    return pdo_execute_return_lastInsertId($sql, $iduser, $name, $addr, $phone, $email, $pttt, $ngaydathang, $total, $discount_code, $discount_percent, $total_final);
}



function insert_cart($iduser, $idpro, $img, $name, $price, $soluong, $thanhtien, $idbill)
{
    $sql = "INSERT INTO cart (iduser, idpro, img, name, price, soluong, thanhtien, idbill) VALUES ('$iduser', '$idpro', '$img', '$name', '$price', '$soluong', '$thanhtien', '$idbill')";
    return pdo_execute($sql);
}

function loadone_bill($id)
{
    $sql = "SELECT * FROM bill WHERE id='$id'";
    $bill = pdo_query_one($sql);
    return $bill;
}

function loadall_cart($idbill)
{
    $sql = "SELECT * FROM cart WHERE idbill='$idbill'";
    $bill = pdo_query($sql);
    return $bill;
}

function loadall_cart_count($idbill)
{
    $sql = "SELECT * FROM cart WHERE idbill='$idbill'";
    $bill = pdo_query($sql);
    return sizeof($bill);
}

function loadall_bill($kyw="",$iduser=0)
{
    $sql = "SELECT * FROM bill WHERE 1";
    if($iduser>0) $sql.=" AND iduser='$iduser'";
    if($kyw!="") $sql.=" AND id LIKE '%$kyw%'";
    $sql.=" ORDER BY id DESC";
    $listbill = pdo_query($sql);
    return $listbill;
}

function get_ttdh($bill_status)
{
    switch ($bill_status) {
        case 0:
            $tt = "Đơn hàng mới";
            break;
        case 1:
            $tt = "Đang xử lý";
            break;
        case 2:
            $tt = "Đang giao hàng";
            break;
        case 3:
            $tt = "Hoàn tất";
            break;
        default:
            $tt = "Đơn hàng mới";
            break;
        
    }
    return $tt;
}


function loadall_thongke()
{
    $sql = "SELECT danhmuc.id as madm, danhmuc.name as tendm, count(sanpham.id) as countsp, min(sanpham.price) as minprice, max(sanpham.price) as maxprice, avg(sanpham.price) as avgprice";
    $sql.=" FROM sanpham left join danhmuc on danhmuc.id=sanpham.iddm";
    $sql.=" GROUP BY danhmuc.id ORDER BY danhmuc.id DESC";
    $listthongke = pdo_query($sql);
    return $listthongke;
}