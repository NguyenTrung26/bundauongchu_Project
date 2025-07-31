<?php
    include "../../model/pdo.php";
    include "../../model/binhluan.php";
    session_start();
    $iduser = $_SESSION['user']['id'];
    $idpro = $_REQUEST['idpro'];
    $dsbl = loadall_binhluan($idpro);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div class="row mb">
    <div class="boxtitle">BÌNH LUẬN</div>
    <div class="boxcontent2 binhluan">
        <table>    
            <?php
            foreach ($dsbl as $bl) {
                extract($bl);
                echo '<tr?><td>'.$noidung.'</td>';
                echo '<td>'.$ngaybinhluan.'</td>';
                echo '<td>'.$iduser.'</td></tr>'; 
            }
            ?>
        </table>
    </div>
    <div class="boxfooter binhluanform">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <input type="hidden" name="idpro" value="<?php echo $idpro; ?>">
            <input type="text" name="noidung" placeholder="Nhập bình luận">
            <input type="submit" name="guibinhluan" value="Gửi">

        </form>
    <?php
    if (isset($_POST['guibinhluan'])) {
        $noidung = $_POST['noidung'];
        $idpro = $_POST['idpro'];
        $iduser = $_SESSION['user']['id']; //iduser
        $ngaybinhluan = date('Y-m-d H:i:s');
        insert_binhluan($noidung, $idpro, $iduser, $ngaybinhluan);
        header("Location:".$_SERVER['HTTP_REFERER']);
    }

    ?>
    </div>
</div>
</body>

</html>