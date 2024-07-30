<?php
if (isset($_GET['data'])) {
    switch ($_GET['data']) {
        case 'home':
            include 'home.php';
            break;
        case 'pp1':
            include 'pp1.php';
            break;
        default:
            include 'home.php';
            break;
    }
} else {
    include 'home.php';
}
