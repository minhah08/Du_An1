<?php
session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Icon -->
    <link rel="icon" href="./assets/img/logo/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS thuần -->
    <link rel="stylesheet" href="./assets/css/styles.user.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Start header -->
    <?php include './user/layout/header.php'; ?>
    <!-- End header  -->

    <main class="d-flex justify-content-center w-100">

        <div class="container">
            <?php
            include './model/pdo.php';
            include './model/accounts.php';
            include './model/products.php';
            include './model/categories.php';
            include './model/comments.php';
            include './model/orders.php';
            include './model/carts.php';
            include './model/discount_code.php';
            $list_category_home = load_all_category_home();

            if ($_GET['act']) {
                switch ($_GET['act']) {
                    case 'home':
                        include './user/home.php';
                        break;
                    case 'menu':
                        include './user/products.php';
                        break;
                    case 'login':
                        // xóa session error
                        unset($_SESSION['error']);
                        // kiểm tra phương thức gửi form đi
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            // kiểm tra dữ liệu
                            if (empty($username)) {
                                $_SESSION['error']['username'] = 'Bạn chưa nhập tên đăng nhập';
                            } else {
                                if (strlen($username) < 6) {
                                    $_SESSION['error']['username'] = 'Tên đăng nhập phải có ít nhất 6 ký tự';
                                }
                            }
                            if (empty($password)) {
                                $_SESSION['error']['password'] = 'Bạn chưa nhập mật khẩu';
                            } else {
                                if (strlen($password) < 6) {
                                    $_SESSION['error']['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
                                }
                            }
                            if (empty($_SESSION['error'])) {
                                $check_login = getAccountByUsername($username);
                                if ($username == $check_login['username'] && $password == $check_login['password']) {
                                    $_SESSION['user'] = $check_login;
                                    if ($check_login['role'] == 0) {
                                        echo "<script>window.location.href = 'admin/index.php?action=dashboard';</script>";
                                    } else {
                                        echo "<script>window.location.href = '?act=home';</script>";
                                    }
                                } else {
                                    $_SESSION['error']['login'] = 'Tên đăng nhập hoặc mật khẩu không chính xác';
                                }
                            }
                        }
                        include 'user/login.php';
                        break;
                    case 'signup':
                        // xóa session error
                        unset($_SESSION['error']);
                        // kiểm tra phương thức gửi form đi
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $re_password = $_POST['re_password'];
                            $access_policy = $_POST['access_policy'];
                            // kiểm tra dữ liệu
                            if (empty($username)) {
                                $_SESSION['error']['username'] = 'Bạn chưa nhập tên đăng nhập';
                            } else {
                                if (strlen($username) < 6) {
                                    $_SESSION['error']['username'] = 'Tên đăng nhập phải có ít nhất 6 ký tự';
                                } else {
                                    $user_check = getAllAccounts();
                                    foreach ($user_check as $key => $value) {
                                        if ($value['username'] == $username) {
                                            $_SESSION['error']['username'] = 'Tên đăng nhập đã tồn tại';
                                        }
                                        break;
                                    }
                                }
                            }
                            if (empty($email)) {
                                $_SESSION['error']['email'] = 'Bạn chưa nhập email';
                            } else {
                                $regex_email = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                                if (!preg_match($regex_email, $email)) {
                                    $_SESSION['error']['email'] = 'Email không hợp lệ';
                                } else {
                                    foreach ($user_check as $key => $value) {
                                        if (mb_strtolower($value['email']) == mb_strtolower($email)) {
                                            $_SESSION['error']['email'] = 'Email đã tồn tại';
                                        }
                                        break;
                                    }
                                }
                            }
                            if (empty($password)) {
                                $_SESSION['error']['password'] = 'Bạn chưa nhập mật khẩu';
                            } else {
                                if (strlen($password) < 6) {
                                    $_SESSION['error']['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
                                }
                            }
                            if (empty($re_password)) {
                                $_SESSION['error']['re_password'] = 'Bạn chưa nhập lại mật khẩu';
                            } else {
                                if ($password != $re_password) {
                                    $_SESSION['error']['re_password'] = 'Mật khẩu nhập lại không khớp';
                                }
                            }
                            if (empty($access_policy)) {
                                $_SESSION['error']['access_policy'] = 'Bạn chưa đồng ý với điều khoản sử dụng';
                            }
                            if (empty($_SESSION['error'])) {
                                signup($username, $email, $password);
                                $_SESSION['success'] = 'Đăng ký thành công';
                                echo "<script>window.location.href = '?act=login';</script>";
                            }
                        }
                        include 'user/signup.php';
                        break;
                    case 'logout':
                        // xóa session user
                        unset($_SESSION['user']);
                        echo "<script>window.location.href = '?act=home';</script>";
                        break;
                    case 'forgot':
                        // xóa session error
                        unset($_SESSION['error']);
                        unset($_SESSION['success']);
                        // kiểm tra phương thức gửi form đi
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $email = $_POST['email'];
                            // kiểm tra dữ liệu
                            if (empty($email)) {
                                $_SESSION['error'] = 'Bạn chưa nhập email';
                            } else {
                                $regex_email = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                                if (!preg_match($regex_email, $email)) {
                                    $_SESSION['error'] = 'Email không hợp lệ';
                                }
                            }
                            if (empty($_SESSION['error'])) {
                                $getAllAccounts = getAllAccounts();
                                foreach ($getAllAccounts as $key => $value) {
                                    if (strtolower($value['email']) == strtolower($email)) {
                                        $password = $value['password'];
                                        forgotPassword($value['username'], $email, $password);
                                        $_SESSION['success'] = 'Mật khẩu mới đã được gửi vào email của bạn';
                                        unset($_SESSION['error']);
                                        break;
                                    } else {
                                        $_SESSION['error'] = 'Email không tồn tại';
                                    }
                                }
                            }
                        }
                        include 'user/forgot.php';
                        break;
                    case 'cart':
                        $load_card = load_cart($_SESSION['user']['id']);
                        if (isset($_POST['btn_code_discount'])) {
                            $code_discount = $_POST['code_discount'];
                            if ($code_discount != '' || $code_discount != null) {
                                if ($code_discount == checkCodeDiscount($code_discount)['code'] && checkCodeDiscount($code_discount)['quantity'] > 0) {
                                    $discount = checkCodeDiscount($code_discount)['discount'];
                                    $id_code_discount = checkCodeDiscount($code_discount)['id'];
                                } else {
                                    $discount = 0;
                                    $id_code_discount = null;
                                }
                            } else {
                                $discount = 0;
                                $id_code_discount = null;
                            }
                        } else {
                            $id_code_discount = null;
                            $discount = 0;
                        }
                        include 'user/cart.php';
                        break;
                    case 'pay':
                        unset($_SESSION['error']);
                        $getAccountById = getAccountById($_SESSION['user']['id']);
                        $load_card = load_cart($_SESSION['user']['id']);
                        // Code discount
                        if (isset($_POST['discount'])) {
                            $discount = $_POST['discount'];
                            $id_code_discount = $_POST['id_code_discount'];
                        } else {
                            $discount = 0;
                            $id_code_discount = null;
                        }
                        if (isset($_POST['submit_order'])) {
                            $fullname = $_POST['fullname'];
                            $email = $_POST['email'];
                            $tel = $_POST['tel'];
                            $address = $_POST['address'];
                            $notes = $_POST['notes'] ?? null;
                            if (isset($_POST['id_code_discount']) && ($_POST['id_code_discount'] != '')) {
                                $id_code_discount = $_POST['id_code_discount'];
                                $discount = checkDiscountCode($id_code_discount)['discount'];
                            } else {
                                $id_code_discount = null;
                            }
                            // Tạo một đối tượng DateTime
                            $date = new DateTime();
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date_now = new DateTime();
                            // Lấy ra ngày tháng năm ở định dạng Y-m-d
                            $order_date = $date_now->format('Y-m-d');
                            $id_status = 0;
                            $id_account = $_SESSION['user']['id'];

                            // Validate dữ liệu
                            $_SESSION['error']['check'] = true;
                            if (empty($fullname)) {
                                $_SESSION['error']['fullname'] = 'Bạn chưa nhập họ tên';
                                $_SESSION['error']['check'] = false;
                            }
                            if (!isset($email) || $email == "") {
                                $_SESSION['error']['email'] = 'Bạn chưa nhập email';
                                $_SESSION['error']['check'] = false;
                            } else {
                                $regex_email = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                                if (!preg_match($regex_email, $email)) {
                                    $_SESSION['error']['email'] = "Email không hợp lệ";
                                    $_SESSION['error']['check'] = false;
                                }
                            }
                            if (!isset($tel) || $tel == "") {
                                $_SESSION['error']['tel'] = "Số điện thoại không được để trống";
                                $_SESSION['error']['check'] = false;
                            } else { 
                                if ((strlen($tel) != 10) || !is_numeric($tel)) {
                                    $_SESSION['error']['tel'] = "Số điện thoại không hợp lệ";
                                    $_SESSION['error']['check'] = false;
                                }
                            }
                            
                            if (!isset($address) || $address == "") {
                                $_SESSION['error']['address'] = "Địa chỉ không được để trống";
                                $_SESSION['error']['check'] = false;
                            }

                            if ($_SESSION['error']['check'] == true) {
                                // Add order 
                                addOrder($order_date, $id_status, $id_account, $notes, $fullname, $email, $tel, $address);
                                $id_order = getLastIdOrder()['id'];
                                // Add order_detail 
                                foreach ($load_card as $card) {
                                    extract($card);
                                    $temp_price = $price * $quantity;
                                    $discount = $discount / 100 * $temp_price;
                                    $total_amount = $temp_price - $discount;
                                    $id_product_variants = $id_product_variants;
                                    addOrderDetail($id_order, $id_product_variants, $quantity, $total_amount, $id_code_discount, $notes);
                                    updateQuantityProductVariants($id_product_variants, $quantity);
                                    $discount = 0;
                                }
                                delCart($_SESSION['user']['id'], "all");
                                echo "<script>window.location.href = '?act=order';</script>";
                            }
                        }
                        include 'user/pay.php';
                        break;
                    case 'add_to_card':

                        if (isset($_POST['addtocart'])) {
                            $id_product = $_POST['id_product'];
                            if (!isset($_POST['exp'])) {
                                $_SESSION['error']['size'] = "Vui lòng chọn size sản phẩm!";
                                echo "<script>window.location.href = '?act=product_detail&id=$id_product';</script>";
                            } else {
                                $id_account = $_SESSION['user']['id'];
                                $quantity = $_POST['quantity'];
                                $id_size = $_POST['exp'];
                                $id_size = $id_size[0];
                                $id_product_variants = getIdProductVariants($id_product, $id_size)['id'];

                                $checkQuantityProductCart = checkQuantityProductCart($id_account, $id_product_variants);
                                if ($checkQuantityProductCart) {
                                    $quantityCheck = $quantity + $checkQuantityProductCart['quantity'];
                                    if (getProductVariants($id_product_variants)['quantity'] < $quantityCheck) {
                                        $_SESSION['error']['quantity'] = "Số lượng sản phẩm không đủ!<br> Giỏ hàng của bạn đã tồn tại " . $checkQuantityProductCart['quantity'] . " sản phẩm này";
                                        echo "<script>window.location.href = '?act=product_detail&id=$id_product';</script>";
                                    } else {
                                        addToCard($id_account, $id_product_variants, $quantity, $checkQuantityProductCart);
                                        echo "<script>window.location.href = '?act=cart';</script>";
                                    }
                                } else {
                                    addToCard($id_account, $id_product_variants, $quantity, $checkQuantityProductCart);
                                    echo "<script>window.location.href = '?act=cart';</script>";
                                }
                            }
                        }
                        break;
                    case 'delcart':
                        $id_account = $_SESSION['user']['id'];
                        $id_cart = $_GET['id_cart'];
                        if (isset($_GET['id_cart'])) {
                            delCart($id_account, $id_cart);
                            echo "<script>window.location.href = '?act=cart';</script>";
                        }
                        break;
                    case 'list_search_products':
                        if (isset($_POST['keyw']) && ($_POST['keyw'] != '')) {
                            $keyw = $_POST['keyw'];
                        } else {
                            $keyw = '';
                        }
                        $list_search_products = list_search_products($keyw);
                        include 'user/products_list_search.php';
                        break;
                    case 'product_detail':
                        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                            $id = $_GET['id'];
                            $one_product =  load_one_product($id);
                            $list_comments = load_all_comment_product($id);
                            $count_comments = count_comments($id);
                            extract($one_product);
                            $id_category = $one_product[0]['id_category'];
                            $similar_product = similar_product($id_category);
                        }
                        include 'user/product_detail.php';
                        break;
                    case 'comment_user':
                        if (isset($_POST['send']) && ($_POST['send'])) {
                            $content = $_POST['content'];
                            $id_product = $_POST['id_product'];
                            $id_account = $_SESSION['user']['id'];

                            $date = new DateTime();
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date_now = new DateTime();
                            $comment_date = $date_now->format('Y-m-d');

                            if (empty($content)) {
                                $_SESSION['error']['content'] = 'Bạn chưa nhập nội dung bình luận';
                            } else {
                                insert_comment($content, $id_account, $id_product, $comment_date);
                            }
                            echo "<script>window.location.href = '?act=product_detail&id=$id_product';</script>";
                        }
                        break;
                    case 'order':
                        if (isset($_SESSION['user'])) {
                            $getAllStatusOrder = getAllStatusOrder();
                            $id_status = null;
                            if (isset($_GET['status'])) {
                                $id_status = $_GET['status'];
                            }
                            $getOrdersByAccount = getOrdersByAccount($_SESSION['user']['id'], $id_status);
                            include 'user/order.php';
                        } else {
                            echo "<script>window.location.href = '?act=login';</script>";
                        }
                        break;
                    case 'cancel_order':
                        $id_order = $_GET['id_order'];
                        cancelOrder($id_order);
                        echo "<script>window.location.href = '?act=order';</script>";
                        break;
                    case 'profile':
                        if (isset($_SESSION['user'])) {
                            $getAccountById = getAccountById($_SESSION['user']['id']);
                            if (isset($_POST['btn_edit'])) {
                                $id = $_SESSION['user']['id'];
                                $username = $_POST['username'];
                                $email = $_POST['email'];
                                $fullname = $_POST['fullname'];
                                $tel = $_POST['tel'];
                                $address = $_POST['address'];

                                if ($_FILES['avatar']['name'] != "") {
                                    $avatar = $_FILES['avatar']['name'];
                                    $target_dir = "assets/img/accounts/";
                                    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                                    move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
                                } else {
                                    $avatar = $getAccountById['avatar'];
                                }
                                updateProfile($id, $username, $email, $fullname, $avatar, $address, $tel);
                                echo "<script>window.location.href = '?act=profile';</script>";
                            }
                            include 'user/profile.php';
                        } else {
                            echo "<script>window.location.href = '?act=login';</script>";
                        }
                        break;
                    case 'article':
                        include './user/article/index.php';
                        break;
                    default:
                        include './user/home.php';
                        break;
                }
            } else {
                include './user/home.php';
            }
            ?>
        </div>
    </main>

    <!-- Start footer -->
    <?php include './user/layout/footer.php'; ?>
    <!-- End footer  -->
</body>

</html>