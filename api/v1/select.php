<?php
    require 'api/v1/models/models.php';
    
    $root = dirname(__FILE__);
    require $root.'/../../config/isLogin.php';

    $select_data = "";
    $fields = $models[$model_select_data];
    $select = "$model_select_data.id, $model_select_data.created_at, $model_select_data.updated_at, $model_select_data.trash" ;
    foreach($fields as $field_name => $field) {
        if(is_array($field)){
            $field_model = $field['model'];
            $includes = $models[$field_model];
            $include_field = "'id', id";
            foreach($includes as $include_name => $include) {
                $include_field .= "'$include_name', $include_name";
            }

            $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_field)) FROM `$field_model` WHERE trash = 0 AND id = $field_name) as $field_model ";
        } else{
            $select .= ", ".$model_select_data.".".$field_name;
        }
    }
    $select_data = $mysqli->query("SELECT $select FROM `$model_select_data` WHERE trash = 0");
    
    
