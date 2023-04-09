<?php
    function inputTitle($str){
        $str = str_replace("_"," ",$str);
        return ucwords($str);
    }