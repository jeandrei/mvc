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


    public function register($data){      
        $this->db->query('
                             INSERT INTO pessoa SET
                             pessoaNome          = :pessoaNome, 
                             pessoaEmail         = :pessoaEmail, 
                             pessoaTelefone      = :pessoaTelefone,
                             pessoaCelular       = :pessoaCelular,
                             pessoaMunicipio     = :pessoaMunicipio,
                             bairroId            = :bairroId,
                             pessoaLogradouro    = :pessoaLogradouro,pessoaUf            = :pessoaUf,
                             pessoaNascimento    = :pessoaNascimento,
                             pessoaCpf           = :pessoaCpf');
         $this->db->bind(':pessoaNome',$data['pessoaNome']);
         $this->db->bind(':pessoaEmail',$data['pessoaEmail']);
         $this->db->bind(':pessoaTelefone',$data['pessoaTelefone']);
         $this->db->bind(':pessoaCelular',$data['pessoaCelular']);
         $this->db->bind(':pessoaMunicipio',$data['pessoaMunicipio']);
         $this->db->bind(':bairroId',$data['bairroId']);
         $this->db->bind(':pessoaLogradouro',$data['pessoaLogradouro']);        
         $this->db->bind(':pessoaUf',$data['pessoaUf']);
         $this->db->bind(':pessoaNascimento',$data['pessoaNascimento']);
         $this->db->bind(':pessoaCpf',$data['pessoaCpf']);       
        
         if($this->db->execute()){             
            return true;  
         } else {
            return false;
         }
         
     }
}
?>