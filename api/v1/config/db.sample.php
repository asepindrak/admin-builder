<?php
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'admin';
    $db_host = 'localhost';
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }