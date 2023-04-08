<?php
    function routes($route){
        require "config/config.php";
        return $SERVER."/page/".$route;
    }