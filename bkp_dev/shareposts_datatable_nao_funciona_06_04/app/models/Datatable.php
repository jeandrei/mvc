<?php
class Datatable {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }

    public function totalRecords($tabela){
       $sql = "SELECT COUNT(*) AS allcount FROM " . $tabela; 
       $this->db->query($sql); 
       $row = $this->db->single();
       return $row->allcount;
    }

    public function totalRecordwithFilter($tabela,$searchArray){
        $sql = "SELECT COUNT(*) AS allcount FROM ".$tabela." WHERE 1 ". $searchQuery; 
        $this->db->query($sql); 
        $row = $this->db->single();
        return $row->allcount;
    }

    public function empRecords($tabela,$searchQuery,$columnName,$columnSortOrder){
        $sql = "SELECT * FROM ".$tabela." WHERE 1 ".$searchQuery;
        //$sql = "SELECT * FROM ".$tabela." WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset";
        $this->db->query($sql);
      
       
        // Bind values
       /*  foreach ($searchArray as $key=>$search) {
            $this->db->bind(':'.$key, $search);
        } */

        /* $this->db->bind(':limit', (int)$data['row']);
        $this->db->bind(':limit', (int)$data['rowperpage']); */
        $empRecords = $this->db->resultSet();     
        return $empRecords;   
    }
}
?>