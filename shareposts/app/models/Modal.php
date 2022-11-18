<?php
class Modal {
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

    public function buscaNome($nome){
        $this->db->query('SELECT *                          
                          FROM pessoa
                          WHERE
                          pessoa.pessoaNome LIKE "%" :pessoaNome"%"                                               
                          ORDER BY pessoa.pessoaNome ASC
                          ');
        $this->db->bind(':pessoaNome', $nome);
        $results = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $results;
        } else {
            return false;
        }

    }
}
?>