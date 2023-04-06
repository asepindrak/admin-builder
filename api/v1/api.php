<?php
    require 'api/v1/models/models.php';
    
    if($id!=""){
        $fields = $models[$model];
        $select = "$model.id, $model.created_at, $model.updated_at, $model.trash" ;
        foreach($fields as $field_name => $field) {
            if(is_array($field)){
                $field_model = $field['model'];
                $includes = $models[$field_model];
                $include_field = "'id', id";
                foreach($includes as $include_name => $include) {
                    $include_field .= ", '$include_name', $include_name";
                }

                $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_field)) FROM `$field_model` WHERE trash = 0 AND id = $field_name) as $field_model ";
            } else{
                $select .= ", ".$model.".".$field_name;
            }
        }
        $result = $mysqli->query("SELECT $select FROM `$model` WHERE trash = 0 AND id = '$id' limit 1");
    } else{
        $filter_query = "";
        if(isset($_POST)){
            $filter = $_POST;
            //loop $filter
            foreach($filter as $key => $value) {
                //if empty, skip
                if(empty($value)) {
                    continue;
                }
                $filter_query .= " AND `$key` LIKE '%$value%'";
            }
        }

        $fields = $models[$model];
        $select = "$model.id, $model.created_at, $model.updated_at, $model.trash" ;
        foreach($fields as $field_name => $field) {
            if(is_array($field)){
                $field_model = $field['model'];
                $includes = $models[$field_model];
                $include_field = "'id', id";
                foreach($includes as $include_name => $include) {
                    $include_field .= ", '$include_name', $include_name";
                }

                $select .= ", (SELECT JSON_ARRAYAGG(JSON_OBJECT($include_field)) FROM `$field_model` WHERE trash = 0 AND id = $field_name) as $field_model ";
            } else{
                $select .= ", ".$model.".".$field_name;
            }
        }
        //mysqli query get data
        $result = $mysqli->query("SELECT $select FROM `$model` WHERE trash = 0 $filter_query");
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';    
        // echo "SELECT $select FROM `$model` WHERE trash = 0 $filter_query";
        // var_dump($result);
    }
    
