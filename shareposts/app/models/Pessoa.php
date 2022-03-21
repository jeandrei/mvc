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


    public function getPessoasPag($page){        
        $limit = 5;
        $sql = 'SELECT *                          
                FROM pessoa                         
                ORDER BY pessoa.pessoaNome ASC
                ';
        $total_relults = $this->getTotalRows($sql);

        $starting_limit = ($page-1)*$limit;        
        $sql .= 'LIMIT :starting_limit, :limit';
        $this->db->query($sql); 
        $this->db->bind(':starting_limit', $starting_limit);    
        $this->db->bind(':limit', $limit); 
              
        $results = $this->db->resultSet();         
        $total_pages = ceil($total_relults/$limit);

        $html = "<nav aria-label='Page navigation example'>";
        $html .= "<ul class='pagination'>";
        for($page=1; $page <= $total_pages; $page++){
            $html .= "<li class='page-item'><a class='page-link' href='?page=$page' class='links'>$page</a></li>";   
        }
        $html .= "</ul></nav>";

        $data = [
            "results" => $results,
            "totalResults" => $total_relults,
            "total_pages" => $total_pages,
            "paginacao" => $html            
        ];
        return $data;           
    }
}
?>