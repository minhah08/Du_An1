<style>
    section {
        height: 100%;
        margin-top: 50px;
        height: 100vh;
    }

    input[type="text"] {
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
    <div class="text-center" style="width: 100%; margin: 0 auto; display: flex; justify-content: center">
        <div class="border shadow p-5" style="border-radius: 20px;">
            <h2>Bạn quên mật khẩu?</h2>
            <h4>Đừng lo lắng, bạn có thể đặt lại mật khẩu dễ dàng</h4>
            <p>Chúng tôi sẽ gửi cho bạn một email nhận lại mật khẩu của bạn</p>
            <form method="post">
                <div class="mb-3 border-bottom">
                    <input type="text" name="email" class="form-control py-2 ps-2" placeholder="Địa chỉ email của bạn*">
                </div>
                <button type="submit" class="btn mb-3 text-white w-100">Gửi email đặt lại mật khẩu</button> 
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo "<span class='text-danger'>" . $_SESSION['error'] . "</span>";
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                        echo "<span class='text-success'>" . $_SESSION['success'] . "</span>";
                        unset($_SESSION['success']);
                    }
                    ?> 
            </form>
        </div>
    </div>
</section>