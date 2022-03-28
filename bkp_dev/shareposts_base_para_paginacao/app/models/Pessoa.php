<?php
class Pessoa {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database('pessoa');
    }

    public function getPessoas(){
        $this->db->query('SELECT *                          
                          FROM pessoa                                                
                          ORDER BY pessoa.pessoaNome ASC
                          ');
        $results = $this->db->resultSet(); 
        return $results;           
    }

    //Retorna o número de registros da instrução sql
    public function getTotalRows($sql){
        $this->db->query($sql);      
        $this->db->resultSet();      
        if($this->db->rowCount() > 0){
            return $this->db->rowCount();
        } else {
            return false;
        } 
    }
    
}
?>