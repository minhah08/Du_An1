<link rel="stylesheet" href="./assets/css/styles.user.header.css">
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 12px 16px;
        z-index: 1;
        margin-right: 30px;
        left: -30px;
        top: 30px;
    }

    .dropdown-content a {
        color: #70472b;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<header>
    <div class="wrap-img">
        <a href="index.php?act=home"><img src="assets/img/logo/logo.png" alt="" width="80px"></a>
    </div>
    <ul class="menu-nav m-0">
        <li><a href="index.php?act=home">Trang chủ</a></li>
        <li><a href="index.php?act=menu">Thực đơn</a></li>
        <li><a href="index.php?act=article">Tin tức</a></li>
        <li><a href="#">Giới thiệu</a></li>
        <li><a href="#">Liên hệ</a></li>
    </ul>
    <div class="icon-nav d-flex justify-content-between align-items-center">
        <div class="input-group me-3">
            <button class="rounded-pill border-0 d-flex" type="button" id="search-icon">
                <form action="?act=list_search_products" method="POST">
                    <input type="text" class="search" name="keyw" placeholder="Search..." aria-label="Search" aria-describedby="search-icon">
                    <input type="submit" value="Tìm" name="btn_search" class="search">
                </form>
            </button>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <a href="index.php?act=cart"><i class="fa-solid fa-cart-shopping"></i></a>
        <?php } ?>
        <div class="dropdown">
            <a href=""><i class="fa-solid fa-user"></i></a>
            <div class="dropdown-content">
                <?php if (!isset($_SESSION['user'])) { ?>
                    <a class="dropdown-item  mx-0 my-1 p-0" href="index.php?act=login"><i class="fa-solid fa-user pe-2"></i>Đăng nhập</a>
                <?php } ?>
                <?php if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['id_role'] == 0) { ?>
                        <a class="dropdown-item  mx-0 my-1 p-0" href="./admin/index.php?action=dashboard"><i class="fa-solid fa-toolbox pe-2"></i>Trang quản trị</a>
                    <?php } ?>
                    <a class="dropdown-item  mx-0 my-1 p-0" href="index.php?act=profile"><i class="fa-solid fa-gear pe-2"></i>Tài khoản của tôi</a>
                    <a class="dropdown-item  mx-0 my-1 p-0" href="index.php?act=order"><i class="fa-solid fa-bag-shopping pe-2"></i>Đơn hàng</a>
                    <a class="dropdown-item  mx-0 my-1 p-0" href="index.php?act=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')"><i class="fa-solid fa-right-from-bracket pe-2"></i>Đăng xuất</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>