<?php
class Pessoa {
    private $db;
    private $pag;

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

    //Monta a SQL conforme os parâmetros passados por $options['named_params']
    //que vem lá do controller, executa a query e retorna a paginação
    public function getPessoasPag($page,$options){         
        $sql .= 'SELECT * FROM pessoa WHERE 1';
        $order = ' ORDER BY pessoa.pessoaNome ASC ';
               
        foreach($options['named_params'] as $key=>$value){
            if(!empty($value)){
                $where .= ' AND ' . $key.'='."'".$value."'";
            }    
        }    

        $query = $sql . $where . $order;
        
        try{
            return $this->pag = new Pagination($page,$query,$options);

        }catch(paginationException $e)
        {
            echo $e;
            exit();
        }           
    }
    
}
?>