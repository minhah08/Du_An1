<style>
    input[type="text"],
    input[type="password"] {
        border: none;
        border-bottom: 1px solid #585858;
        border-radius: 0;
        box-shadow: none;
    }

    button[type="submit"] {
        border-radius: 100px !important;
        background-color: #FFC501;
        font-size: 20px;
    }
</style>
<section>
    <div class="row d-flex justify-content-between">
        <div class="col-md-5">
            <div class="background-image">
                <img src="assets/img/banners/bannerLogin.jpg" alt="">
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="col">
                <h2 class="text-uppercase mb-5" style="font-weight: bold;">Đăng nhập tài khoản</h2>
                <form method="post">
                    <div class="mb-3 border-bottom">
                        <input type="text" name="username" class="form-control py-2 ps-0" placeholder="Tên đăng nhập*">
                    </div>
                    <div class="mb-3 border-bottom">
                        <input type="password" name="password" class="form-control py-2 ps-0" placeholder="Mật khẩu*">
                    </div>
                    <a class="text-decoration-none d-inline float-end text-end w-100" style="color: #585858" href="?act=forgot">Quên mật khẩu?</a>
                    <button type="submit" name="submit" class="btn my-3 text-white w-100">Đăng nhập</button>
                    <p class="text-center">Bạn chưa có tài khoản? <a class="text-dark fw-bolder" href="?act=signup">Đăng ký</a></p>
                    <?php 
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">';
                            foreach ($_SESSION['error'] as $key => $value) {
                                echo '<li>' . $value . '</li>';
                            }
                            echo '</div>';
                            
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div> 
</section>