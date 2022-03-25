<?php
class Paginate extends Database{
    
    //MONTA A PAGINAÇÃO
    public function returnpag($page,$limit,$sql,$parametros){ 
        //var_dump($parametros);
        //Pega o total de registros do banco de dados com base na consulta
        $total_relults = $this->getTotalRows($sql); 
        //Primeira linha da paginação tipo da linha 5 até a 10
        $starting_limit = ($page-1)*$limit;    
        //Adiciona ao sql a partir de que linha vai retornar exemplo a partir da linha 5
        $sql .= ' LIMIT :starting_limit, :limit';  
        $this->query($sql); 
        $this->bind(':starting_limit', $starting_limit);    
        $this->bind(':limit', $limit); 
        //Retorna os dados da pesquisa
        $results = $this->resultSet();
        //Retorna o total de páginas         
        $total_pages = ceil($total_relults/$limit);

        $links='';
        foreach($parametros as $key =>$par){        
            $links .= '&'.$key.'='.$par;
        }   
        
        $html = "<nav aria-label='Page navigation example'>";
        $html .= "<ul class='pagination'>";
        
        
        if($page>0){
            $anterior = $page - 1;
        } else {
            $anterior = 1;
        }

        if($total_pages>$page+1){
            $proximo=$page+1;
        } else {
            $proximo=$total_pages;
        }
              

        $html .= "<li class='page-item'><a class='page-link' href='?page=$anterior".$links."' class='links'>Anterior</a></li>";
        for($i=1; $i <= $total_pages; $i++){            
            $ativo = ($i==$page)?"active":"";
            $html .= "<li class='page-item $ativo'><a class='page-link' href='?page=$i".$links."' class='links'>$i</a></li>";   
        }
        $html .= "<li class='page-item'><a class='page-link' href='?page=$proximo".$links."' class='links'>Próximo</a></li>";
        $html .= "</ul></nav>";

        $data = [
            "results" => $results,
            "totalResults" => $total_relults,
            "total_pages" => $total_pages,
            "paginacao" => $html            
        ];
        return $data;  
    }


    //RETORNA O NÚMERO DE LINHAS DA CONSULTA
    public function getTotalRows($sql){  
        $this->query($sql);      
        $this->resultSet();      
        if($this->rowCount() > 0){
            return $this->rowCount();
        } else {
            return false;
        }
    }



    //RETORNA A PAGINAÇÃO
    public function paginac($pag,$limit,$parametros,$tabela,$orderby){         
        $limit = $limit;
        $sql = 'SELECT * FROM ' . $tabela . ' WHERE 1';   
        
        //MONTA O WHERE
        foreach($parametros as $key =>$par){
            if(!empty($par)){
                $where .= ' AND '. $key.'='."'".$par."'";
            } 
        }   
        
        //MONTA ORDERBY
        $order = $tabela.'.'.$orderby;  
        (!empty($where)) ? $sql .= $where:'';
        (!empty($order)) ? $sql .= ' ORDER BY '. $order:'';
        //die(var_dump($sql))          ;
        $paginacao = $this->returnpag($pag,$limit,$sql,$parametros);  
        return $paginacao;       
        
    }


}

?>