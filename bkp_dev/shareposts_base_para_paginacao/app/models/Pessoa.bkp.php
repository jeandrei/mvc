<?php
class Pessoa {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }

    public function getPessoas(){
        $this->db->query('SELECT *                          
                          FROM pessoa                         
                          ORDER BY pessoa.pessoaNome ASC
                          ');
        $results = $this->db->resultSet(); 
        return $results;           
    }
}
?>