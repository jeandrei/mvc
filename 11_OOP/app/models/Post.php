<?php
    class Post{
        private $db;

        public function __construct(){
            //Como eu tenho acesso ao Database aqui?
            //Porque todos os arquivos da pasta libraries
            //são carregados pelo arquivo bootstrap.php
            $this->db = new Database;
        }        

    }
?>