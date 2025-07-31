<div class="row mb ">
    <div class="boxtrai mr ">
        <div class="row mb">
            <?php
            extract($onesp);
            ?>
            <div class="boxtitle"><?= $name ?></div>
            <div class=" row boxcontent">
                <?php
                echo '<div class="row mb imgsp"><img src="view/images/' . $img . '" alt=""></div>
                    <div class="info">
                        <p class="price">$' . $price . '</p>
                        <p class="name">' . $name . '</p>
                        <p class="describe">' . $describe . '</p>
                    </div>';
                ?>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#binhluan").load("view/binhluan/binhluanform.php", {
                    idpro: <?= $id?>
                });
            });
        </script>
        <div class="row" id="binhluan">
            
        </div>
        <div class="row mb">
            <div class="boxtitle">SẢN PHẨM CÙNG LOẠI</div>
            <div class=" row boxcontent">
                <?php
                foreach ($spcungloai as $sp) {
                    extract($sp);
                    echo '<div class="row mb10">
                        <div class="row imgcungloai"><a href="index.php?act=sanphamct&idsp=' . $id . '"><img src="view/images/' . $img . '" alt=""></a></div>
                        <a href="index.php?act=sanphamct&idsp=' . $id . '">' . $name . '</a>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="boxphai">
        <?php include 'boxright.php'; ?>
    </div>
</div>