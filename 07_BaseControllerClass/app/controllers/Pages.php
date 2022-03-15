<?php
    class Pages extends Controller{
        public function __construct(){
           
        }

        public function index(){
            echo 'This is the index page of Pages Class';
        }
    
        public function about($id){
            echo 'This is about and id is: ' . $id;
        }
    }
?>