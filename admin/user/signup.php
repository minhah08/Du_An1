<style>
    input[type="text"],
    input[type="password"] {
        border: none;
        border-bottom: 1px solid #ced4da;
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
                <h2 class="text-uppercase mb-5" style="font-weight: bold;">Đăng ký tài khoản</h2>
                <form method="post">
                    <div class="mb-3 border-bottom">
                        <input type="text" name="username" class="form-control py-2 ps-0" placeholder="Tên đăng nhập*">
                    </div> 
                    <div class="mb-3 border-bottom">
                        <input type="text" name="email" class="form-control py-2 ps-0" placeholder="Email*">
                    </div> 
                    <div class="mb-3 border-bottom">
                        <input type="password" name="password" class="form-control py-2 ps-0" placeholder="Mật khẩu*">
                    </div>
                    <div class="mb-3 border-bottom">
                        <input type="password" name="re_password" class="form-control py-2 ps-0" placeholder="Nhập lại mật khẩu*">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="access_policy" class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">Tôi đồng ý với các điều khoản sử dụng </label>
                    </div>
                    <button type="submit" class="btn mb-3 text-white w-100">Đăng ký</button>
                    <p class="text-center">Bạn đã có tài khoản? <a class="text-dark fw-bolder" href="?act=login">Đăng nhập</a></p>
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