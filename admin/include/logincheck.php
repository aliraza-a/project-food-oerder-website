<?php

if (!isset($_SESSION['user'])) {
    $_SESSION['no_login_message'] = "Please login first!";
    header('location:' . SITEURL . '/admin/login.php');
}
