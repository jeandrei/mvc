<?php
class Bairro {
    private $db;

    public function __construct(){
        //inicia a classe Database
        $this->db = new Database;
    }

   // Find bairro by id
   public function getBairroById($id){
        $this->db->query('SELECT bairroNome FROM bairro WHERE bairroId = :id');
        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return $row->bairroNome;
        } else {
            return false;
        }
    }

}
?>