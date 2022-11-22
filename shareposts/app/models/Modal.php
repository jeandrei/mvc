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

    public function search($nome=null, $municipio=null){                
        $sql = 'SELECT * FROM pessoa WHERE 1';
        
        $bind = [];

         if($nome != null){
            $sql.= ' AND pessoa.pessoaNome LIKE "%" :pessoaNome"%"';
            $bind = [':pessoaNome' => $nome];            
        } 

        if($municipio != null){
            $sql.= ' AND pessoa.pessoaMunicipio LIKE "%" :pessoaMunicipio"%"';
            $bind += [':pessoaMunicipio' => $municipio];            
        }
        
        
        
        
        $this->db->query($sql);
        
        foreach($bind as $key => $value){             
            $this->db->bind($key, $value);            
        }
        
        $results = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            return $results;
        } else {
            return false;
        }

    }
}
?>