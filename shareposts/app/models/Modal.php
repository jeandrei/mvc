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
        
        $sql.= ' ORDER BY pessoa.pessoaNome ASC';
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


     public function delete($id){
        $this->db->query('DELETE FROM pessoa WHERE pessoa.pessoaId = :id');
        $this->db->bind(':id',$id);
        if($this->db->execute()){             
            return true;  
         } else {
            return false;
         }
     }

     public function getPessoaById($id){
        $this->db->query('
                        SELECT
                                *
                        FROM
                                pessoa
                        WHERE 
                                pessoaId = :id
                        ');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        //verificq se teve algum resultado
        if($this->db->rowCount() > 0){
            return $row;
        } else {
            return false;
        }         
    }


    public function update($data){        
        $this->db->query('
                             UPDATE pessoa SET
                             pessoaNome          = :pessoaNome, 
                             pessoaEmail         = :pessoaEmail, 
                             pessoaTelefone      = :pessoaTelefone,
                             pessoaCelular       = :pessoaCelular,
                             pessoaMunicipio     = :pessoaMunicipio,
                             bairroId            = :bairroId,
                             pessoaLogradouro    = :pessoaLogradouro,pessoaUf            = :pessoaUf,
                             pessoaNascimento    = :pessoaNascimento,pessoaCpf           = :pessoaCpf
                             WHERE pessoaId = :pessoaId                      
                         ');
         $this->db->bind(':pessoaId',$data['pessoaId']);                
         $this->db->bind(':pessoaNome',$data['updatePessoaNome']);
         $this->db->bind(':pessoaEmail',$data['updatePessoaEmail']);
         $this->db->bind(':pessoaTelefone',$data['updatePessoaTelefone']);
         $this->db->bind(':pessoaCelular',$data['updatePessoaCelular']);
         $this->db->bind(':pessoaMunicipio',$data['updatePessoaMunicipio']);
         $this->db->bind(':bairroId',$data['updateBairroId']);
         $this->db->bind(':pessoaLogradouro',$data['updatePessoaLogradouro']);         
         $this->db->bind(':pessoaUf',$data['updatePessoaUf']);
         $this->db->bind(':pessoaNascimento',$data['updatePessoaNascimento']); 
         $this->db->bind(':pessoaCpf',$data['updatePessoaCpf']);               
 
         if($this->db->execute()){ 
                return true;
            } else {
                return false;
            }                        
         
         
     }

    
}
?>