<?php
    require 'api/v1/models/models.php';

    //mysqli query get table
    $result = $mysqli->query("SELECT * FROM $model");
