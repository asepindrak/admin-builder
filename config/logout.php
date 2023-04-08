<?php
    require 'config.php';
    setcookie('user', "", time() + (86400 * 30), "/"); // 86400 = 1 day
    unset($_COOKIE['user']);
    header('location:'.$SERVER);