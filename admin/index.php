<?php
include '../model/pdo.php';
include '../model/danhmuc.php';
include '../model/sanpham.php';
include '../model/taikhoan.php';
include '../model/binhluan.php';
include '../model/cart.php';
include 'header.php';

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        // danhmuc

        case 'adddm':
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tenloai = $_POST['tenloai'];
                danhmuc_insert($tenloai);
                header("Location: index.php?act=listdm");
                exit;
            }
            include 'danhmuc/add.php';
            break;


        case 'listdm':
            $listdanhmuc = danhmuc_loadall();
            include 'danhmuc/list.php';
            break;

        case 'xoadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                danhmuc_delete($_GET['id']);
            }
            $listdanhmuc = danhmuc_loadall();
            include 'danhmuc/list.php';
            break;

        case 'suadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $danhmuc = danhmuc_loadone($_GET['id']);
            }
            include 'danhmuc/update.php';
            break;
        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $tenloai = $_POST['tenloai'];
                danhmuc_update($id, $tenloai);
                $thongbao = "Cập nhật thành công";
            }
            $listdanhmuc = danhmuc_loadall();
            include 'danhmuc/list.php';
            break;
        case 'dskh':
            $listtaikhoan = taikhoan_loadall();
            include 'taikhoan/list.php';
            break;
        case 'dsbl':
            $listbinhluan = loadall_binhluan(0);
            include 'binhluan/listbinhluan.php';
            break;
        case 'xoabl':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $sql = "delete from binhluan where id=" . $_GET['id'];
                pdo_execute($sql);
            }
            $listbinhluan = loadall_binhluan(0);
            include 'binhluan/listbinhluan.php';
            break;
        // case 'thongke':
        //     include 'thongke.php';
        //     break;

        //     // sanphamaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

        case 'addsp':
            // Check if the user has submitted the form
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $iddm = $_POST['iddm'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $describe = $_POST['describe'];
                $filename = $_FILES['img']['name'];
                $target_dir = "upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);

                // Ensure the upload directory exists
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    // File uploaded successfully
                } else {
                    // Handle the error
                    echo "Sorry, there was an error uploading your file.";
                }

                sanpham_insert($name, $price, $describe, $filename, $iddm);
                $thongbao = "Thêm mới thành công";
            }
            $listdanhmuc = danhmuc_loadall();
            include 'sanpham/add.php';
            break;

        case 'listsp':
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $keyw = $_POST['keyw'];
                $iddm = $_POST['iddm'];
            } else {
                $keyw = "";
                $iddm = 0;
            }
            $listdanhmuc = danhmuc_loadall();
            $listsanpham = sanpham_loadall($keyw, $iddm);
            include 'sanpham/list.php';
            break;

        case 'xoasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                sanpham_delete($_GET['id']);
            }
            $listsanpham = sanpham_loadall("", 0);
            include 'sanpham/list.php';
            break;

        case 'suasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $sanpham = sanpham_loadone($_GET['id']);
            }
            $listdanhmuc = danhmuc_loadall();
            include 'sanpham/update.php';
            break;
        case 'updatesp':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $name = $_POST['tensp'];
                $price = $_POST['giasp'];
                $describe = $_POST['motasp'];
                $filename = $_FILES['hinhsp']['name'];
                $iddm = $_POST['iddm'];
                $target_dir = "upload/";
                $target_file = $target_dir . basename($_FILES["hinhsp"]["name"]);
                if (move_uploaded_file($_FILES["hinhsp"]["tmp_name"], $target_file)) {
                    // File uploaded successfully
                } else {
                    // Handle the error
                    echo "Sorry, there was an error uploading your file.";
                }

                sanpham_update($id, $name, $price, $describe, $filename, $iddm);
                $thongbao = "Cập nhật thành công";
            }
            $listsanpham = sanpham_loadall("", 0);
            include 'sanpham/list.php';
            break;
        case 'thongke':
            $listthongke = loadall_thongke();
            include 'thongke/list.php';
            break;
        case 'bieudo':

            include 'thongke/bieudo.php';
            break;
        case 'listbill':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $listbill = loadall_bill($kyw, 0);
            include 'bill/listbill.php';
            break;

        default:
            $listthongke = loadall_thongke();
            include 'home.php';
    }
} else {
    $listthongke = loadall_thongke();
    include 'home.php';
}




include 'footer.php';
