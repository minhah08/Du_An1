<link rel="stylesheet" href="./assets/css/styles.user.home.css">

<main class="mb-5 pb-5" style="width: 100%;">

    <div class="slideshow-container"> 
        <div class="mySlides">
            <img src="assets/img/banners/banner2.png" style="width: 100%;">
        </div>

        <div class="mySlides">
            <img src="assets/img/banners/banner3.png" style="width: 100%;">
        </div>

        <div class="mySlides">
            <img src="assets/img/banners/banner4.png" style="width: 100%;">
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <div class="index-bottom">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <div class="background-menu">
        <h1 style="padding-top: 15px">Menu của chúng tôi</h1>
        <div class="wrap-menu mb-10">
            <?php
            foreach ($list_category_home as $category) {
                extract($category);
            ?>
                <div class="menu-item">
                    <a href="?act=menu&name=#<?php echo $name_category ?>">
                        <img src="<?php echo 'assets/img/categories/' . $image ?>" alt="">
                    </a>
                    <a href="?act=menu&name=#<?php echo $name_category ?>">
                        <h3 style="padding-top: 10px;"><?php echo $name_category ?></h3>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="map mt-5 pt-5">
        <h3 class="mb-5">Địa chỉ cửa hàng</h3>
        <div class="mt-5" style="display: flex; justify-content: center; align-items: center">
            <div class="col-md-3">
                <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 300px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1861.9329802809737!2d105.7458325!3d21.0380486!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455305afd834b%3A0x17268e09af37081e!2sT%C3%B2a%20nh%C3%A0%20FPT%20Polytechnic.!5e0!3m2!1svi!2s!4v1700367362695!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-3 text-start ms-5">
                <div class="item-info d-flex">
                    <i class="fa-solid fa-location-dot me-2 mt-1"></i>
                    <p>Tòa nhà FPT Polytechnic, 13 <br>
                        phố Trịnh Văn Bô, phường<br>
                        Phương Canh, quận Nam Từ<br>
                        Liêm, TP Hà Nội </p>
                </div>
                <div class="item-info d-flex">
                    <i class="fa-solid fa-phone me-2 mt-1"></i>
                    <p>Điện thoại: +84 123456789</p>
                </div>
                <div class="item-info d-flex">
                    <i class="fa-solid fa-envelope me-2 mt-1"></i>
                    <p>Email: fastfood@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include 'scroll.php'; ?>

<script>
    /* Slideshow JavaScript */
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        };
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].classList.remove("active");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].classList.add("active");
    }
    /* Slideshow JavaScript */
</script>