<?php
echo __DIR__."/../models/user.php";
    require_once(__DIR__."/../models/user.php");
    class User {
        public $controller;
        public $data;

        function __construct() {
            $this->controller = 'users';
            $this->data = new UserModel();
        }

        
        function get(){
            $result = $this->data->get();
            print_r($result);
            include '../views/user.php';
        }

        
        function set($data){
            $result = $this->data->set($data);
            return $result;
        }

        
        function update($data, $id){
            $result = $this->data->update($data, $id);
            return $result;
        }

        
        function delete($id){
            $result = $this->data->delete($id);
            return $result;
        }

        
        function restore($id){
            $result = $this->data->restore($id);
            return $result;
        }

    }