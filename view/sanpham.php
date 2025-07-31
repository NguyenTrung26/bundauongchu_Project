<div class="row mb ">
    <div class="boxtrai mr ">
        <div class="row mb">
            <div class="boxtitle">SẢN PHẨM <strong><?= $tendm ?></strong></div>
            <div class=" row boxcontent">
                <?php
                $i = 0;
                foreach ($dssp as $sp) {
                    extract($sp);
                    if (($i == 2) || ($i == 5) || ($i == 8) || ($i == 11)) {
                        $mr = "";
                    } else {
                        $mr = "mr";
                    }
                    echo '<div class="boxsp">
                       <div class="row img"><a class="name" href="index.php?act=sanphamct&idsp=' . $id . '"><img src="view/images/' . $img . '" alt=""></a></div>
                       <div class="info">
                           <p class="price">$' . $price . '</p>
                           <a class="name" href="index.php?act=sanphamct&idsp=' . $id . '">' . $name . '</a>
                       </div>
                   </div>';
                    $i++;
                }
                ?>
            </div>
        </div>

    </div>
    <div class="boxphai">
        <?php include 'boxright.php'; ?>
    </div>
</div>