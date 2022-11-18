<?php


class Conteudo extends Controller{
    public function __construct(){

    }

    
    public function javascript(){  
       $this->view('conteudos/javascript');
    }

    public function bootstrap(){  
        $this->view('conteudos/bootstrap');
     }


   
    
}