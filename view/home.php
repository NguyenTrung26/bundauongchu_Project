<!-- <div class="hero">
    <div class="hero-inner">
        <div class="hero-title">
            <h1 class="text-light title font-2"></h1>
            <p class="text-capitalize text-light"></p>
        </div>
        <a href="#" class="sd"></a>
    </div>
</div> -->

<div class="row mb ">
    <div class="boxtrai mr ">
        <div class="row">
            <div class="banner">
                <div class="banner-overlay">
                    <div class="banner-text">Chào mừng đến với tiệm Bún Đậu Ông Chú</div>
                </div>

                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <img src="view/images/sl1.jpg" alt="Banner 1">
                        <div class="caption">Hương vị truyền thống - Không thể quên!</div>
                    </div>

                    <div class="mySlides fade">
                        <img src="view/images/sl2.jpg" alt="Banner 2">
                        <div class="caption">Đậm đà bản sắc miền Bắc</div>
                    </div>

                    <div class="mySlides fade">
                        <img src="view/images/sl3.jpg" alt="Banner 3">
                        <div class="caption">Bún đậu mắm tôm chuẩn vị Hà Nội</div>
                    </div>

                </div>

                <!-- Dots -->
                <div class="dots">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>

        </div>
        <div class="row">
            <?php
            $i = 0;
            foreach ($spnew as $sp) {
                extract($sp);
                if (($i == 2) || ($i == 5) || ($i == 8)) {
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
                    <div class="row btnaddtocart">
                    <form action="index.php?act=addtocart" method="post">
                        <input type="hidden" name="id" value="' . $id . '">
                        <input type="hidden" name="name" value="' . $name . '">
                        <input type="hidden" name="img" value="' . $img . '">
                        <input type="hidden" name="price" value="' . $price . '">
                        <input type="submit" name="addtocart" value="Add to cart">
                    </form>
                    
                    </div>
                    </div>';
                $i++;
            }
            ?>

        </div>
    </div>
    <div class="boxphai">
        <?php include 'boxright.php'; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script>
    // $('.sd').click(function(){
    //     $('.hero, .content').addClass('scrolled');
    // });

    // $('.hero').mousewheel(function(e){
    //     if( e.deltaY < 0 ){
    //         $('.hero, .content').addClass('scrolled');
    //         return false;
    //     }
    // });
    // $(window).mousewheel(function(e){
    //     if( $('.hero.scrolled').length ){
    //         if( $(window).scrollTop() == 0 && e.deltaY > 0 ){
    //             $('.hero, .content').removeClass('scrolled');
    //         }
    //     }
    // });
</script>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 }

        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

        setTimeout(showSlides, 3000); // Chuyển ảnh sau mỗi 4 giây
    }
</script>
