<?php
class Pessoa {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }
}
?>