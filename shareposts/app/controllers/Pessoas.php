<?php 
    class Pessoas extends Controller{
        public function __construct(){            
            $this->userModel = $this->model('Pessoa');
        }

        public function index(){
            $this->view('pessoas/index');
        }

        public function add(){
            $this->view('pessoas/add');
        }

        public function edit(){
            $this->view('pessoas/edit');
        }       
    }
?>