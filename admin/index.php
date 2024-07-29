<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['id_role'] != 0) {
    echo "<script>window.location.href = '../index.php';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <title>
        Trang quản trị
    </title>
    <!-- Icon -->
    <link rel="icon" href="./assets/img/logo/logo.png" type="image/x-icon">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div class="row">
        <div class="col-2">
            <?php include "./layout/sidebar.php" ?>
        </div>
        <section class="col p-0 m-0">
            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
                <header>
                    <?php include './layout/navbar.php'; ?>
                </header>
                <!-- include model -->
                <?php
                include '../model/pdo.php';
                include '../model/revenues.php';
                include '../model/accounts.php';
                include '../model/categories.php';
                include '../model/products.php';
                include '../model/orders.php';
                include '../model/comments.php';
                include "../model/discount_code.php";
                ?>
                <div>
                    <?php
                    if ($_GET['action']) {
                        switch ($_GET['action']) {
                            case 'dashboard':
                                include "./dashboard.php";
                                break;
                            case 'accounts':
                                $getAccounts = getAllAccounts();
                                $pathImg = "../assets/img/accounts/";
                                include 'tables/accounts/accounts.php';
                                break;
                            case 'add_account':
                                unset($_SESSION['error']);
                                $getAllRoles = getAllRoles();
                                $getAccounts = getAllAccounts();

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $fullname = $_POST['fullname'];
                                    $email = $_POST['email'];
                                    $address = $_POST['address'];
                                    $tel = $_POST['tel'];
                                    $id_role = $_POST['id_role'];

                                    if ($_FILES['avatar']['name'] != "") {
                                        $avatar = $_FILES['avatar']['name'];
                                        $target_dir = "../assets/img/accounts/";
                                        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
                                    } else {
                                        $avatar = "profile.jpg";
                                    }

                                    $_SESSION['error']['check'] = true;
                                    if (!isset($username) || $username == "") {
                                        $_SESSION['error']['username'] = "Tên tài khoản không được để trống";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    if (!isset($fullname) || $fullname == "") {
                                        $_SESSION['error']['fullname'] = "Họ và tên không được để trống";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    if (!isset($address) || $address == "") {
                                        $_SESSION['error']['address'] = "Địa chỉ không được để trống";
                                        $_SESSION['error']['check'] = false;
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
                                    $regex_email = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                                    if (!preg_match($regex_email, $email)) {
                                        $_SESSION['error']['email'] = "Email không hợp lệ";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    if (strlen($password) < 8) {
                                        $_SESSION['error']['password'] = "Mật khẩu phải có ít nhất 8 ký tự";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    foreach ($getAccounts as $key => $value) {
                                        if ($value['username'] == $username) {
                                            $_SESSION['error']['username'] = "Tên tài khoản đã tồn tại";
                                            $_SESSION['error']['check'] = false;
                                            break;
                                        }
                                    }
                                    foreach ($getAccounts as $key => $value) {
                                        if ($value['email'] == $email) {
                                            $_SESSION['error']['email'] = "Email đã tồn tại";
                                            $_SESSION['error']['check'] = false;
                                            break;
                                        }
                                    }
                                    if ($_SESSION['error']['check'] == true) {
                                        addAccount($username, $password, $fullname, $avatar, $email, $address, $tel, $id_role);
                                        echo "<script>window.location.href = '?action=accounts';</script>";
                                    }
                                }
                                include 'tables/accounts/add_account.php';
                                break;
                            case 'edit_account':
                                unset($_SESSION['error']);
                                $getAllRoles = getAllRoles();
                                $getAccounts = getAllAccounts();
                                $getAccountById = getAccountById($_GET['acc_id']);

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $fullname = $_POST['fullname'];
                                    $email = $_POST['email'];
                                    $address = $_POST['address'];
                                    $tel = $_POST['tel'];
                                    $id_role = $_POST['id_role'];

                                    if ($_FILES['avatar']['name'] != "") {
                                        $avatar = $_FILES['avatar']['name'];
                                        $target_dir = "../assets/img/accounts/";
                                        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
                                    } else {
                                        $avatar = $getAccountById['avatar'];
                                    }
                                    $_SESSION['error']['check'] = true;
                                    if (!isset($username) || $username == "") {
                                        $_SESSION['error']['username'] = "Tên tài khoản không được để trống";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    if (!isset($fullname) || $fullname == "") {
                                        $_SESSION['error']['fullname'] = "Họ và tên không được để trống";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    if (!isset($address) || $address == "") {
                                        $_SESSION['error']['address'] = "Địa chỉ không được để trống";
                                        $_SESSION['error']['check'] = false;
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
                                    if (strlen($password) < 8) {
                                        $_SESSION['error']['password'] = "Mật khẩu phải có ít nhất 8 ký tự";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    $regex_email = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                                    if (!preg_match($regex_email, $email)) {
                                        $_SESSION['error']['email'] = "Email không hợp lệ";
                                        $_SESSION['error']['check'] = false;
                                    }
                                    foreach ($getAccounts as $key => $value) {
                                        if ($value['username'] == $username) {
                                            if ($getAccountById['username'] != $username) {
                                                $_SESSION['error']['username'] = "Tên tài khoản đã tồn tại";
                                                $_SESSION['error']['check'] = false;
                                                break;
                                            }
                                        }
                                    }
                                    foreach ($getAccounts as $key => $value) {
                                        if ($value['email'] == $email) {
                                            if ($getAccountById['email'] != $email) {
                                                $_SESSION['error']['email'] = "Email đã tồn tại";
                                                $_SESSION['error']['check'] = false;
                                                break;
                                            }
                                        }
                                    }
                                    if ($_SESSION['error']['check'] == true) {
                                        editAccount($_GET['acc_id'], $username, $password, $fullname, $avatar, $email, $address, $tel, $id_role);
                                        echo "<script>window.location.href = '?action=accounts';</script>";
                                    }
                                }
                                include 'tables/accounts/edit_account.php';
                                break;
                            case 'delete_account':
                                deleteAccount($_GET['acc_id']);
                                echo "<script>window.location.href = '?action=accounts';</script>";
                                break;