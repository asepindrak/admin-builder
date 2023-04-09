<?php
    require 'config.php';
    setcookie('access_token', "", time() + (86400 * 30), "/"); // 86400 = 1 day
    unset($_COOKIE['access_token']);
    header('location:'.$SERVER);