<?php 
    class Pessoas extends Controller{
        public function __construct(){            
            $this->userModel = $this->model('Pessoa');
        }

        public function index(){
            echo "Carregou o index";
        }

        public function add(){
            echo "Carregou o add";
        }

        public function edit(){
            echo "Carregou o edit";
        }

        public function delete(){
            echo "Carregou o delete";
        }
    }
?>