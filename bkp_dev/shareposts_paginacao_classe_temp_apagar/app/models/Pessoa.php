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
            $this->pag = new Pagination($page,$query,$options);

        }catch(paginationException $e)
        {
            echo $e;
            exit();
        }   
        return $this->pag;
    }

     //Monta a SQL conforme os parâmetros passados por $options['named_params']
    //que vem lá do controller, executa a query e retorna a paginação
    public function getPessoasPag2($page,$options){         
        $sql .= 'SELECT * FROM pessoa WHERE 1';
        $order = ' ORDER BY pessoa.pessoaNome ASC ';
        //crio um array vazio
        $bind=[];
        foreach($options['named_params'] as $key=>$value){
            if(!empty($value)){
                $where .= ' AND ' . $key.'='.':'.$key;
                //aqui dou um merge para cada linha existente no options['name_params'] montando um novo array
                // que vai ficar algo assim [":pessoaNome"]=> string(5) "TESTE" [":pessoaMunicipio"]=> string(5) "penha"
                $bind = array_merge($bind,[$key => $value]);
            }    
        }    

        
        $query = $sql . $where . $order;
        echo $query; 
        die();
        try{
            $this->pag = new Pagination($page,$query,$options);

        }catch(paginationException $e)
        {
            echo $e;
            exit();
        } 

        //faz o bind com cada linha armazendada dentro do array bind
        foreach($bind as $key=>$value){
            $key = "':".$key."'";
            $value = "'".$value."'";
            $this->pag->bindParam($key, $value, PDO::PARAM_STR, 12);
            //echo 'bindParam('.$key.','.$value.')';  
        }

        $pagination = $this->pag->execute();
       // echo "<pre>";
        var_dump($pagination->resultset->fetchAll());
        //echo "</pre>";
    }




    //Monta a SQL conforme os parâmetros passados por $options['named_params']
    //que vem lá do controller, executa a query e retorna a paginação
    public function getPessoasPag4($page,$options){ 
        $sql = 'SELECT * FROM pessoa WHERE 1';

        $order = ' ORDER BY pessoa.pessoaNome ASC ';

        //SE QUISER FAZER MANUAL SEM O SQL BUILDER
        /* if(!empty($options['named_params'][':pessoaNome'])){
            $where .= ' AND pessoaNome = :pessoaNome';
        } */

        /**
         * MONTA O SQL
         */
        $bind=[];
        foreach($options['named_params'] as $key=>$value){
            if(!empty($value)){
            //SE TIVER ALGUM VALOR REMOVO O : DA CHAVE por exemplo :pessoaNome deixo como pessoaNome
            $and = str_replace(':','',$key);
            //ADICIONO AO SQL AND pessoaNome = :pessoaNome
            $sql .= ' AND ' . $and.' = '.$key; 
            //aqui dou um merge para cada linha existente no options['name_params'] montando um novo array
            // que vai ficar algo assim [":pessoaNome"]=> string(5) "TESTE" [":pessoaMunicipio"]=> string(5) "penha"
            $bind = array_merge($bind,[$key => $value]); 
            }                   
            
        }              
        

        //TENTA EXECUTAR A PAGINAÇÃO 
        try
        {
            $this->pag = new Pagination($page,$sql, $options);  
        }
        catch(paginationException $e)
        {
            echo $e;
            exit();
        }



        //faz o bind com cada linha armazendada dentro do array bind
         foreach($bind as $key=>$value){            
            $this->pag->bindParam($key, $value, PDO::PARAM_STR, 12);            
        } 


        //SE FIZER MANUAL UTILIZE ESSA LINHA COMO EXEMPLO PARA O BIND
        // $pagination->bindParam(':pessoaNome', 'Pessoa 01', PDO::PARAM_STR, 12);

        //EXECUTA A PAGINAÇÃO
        $this->pag->execute();
        //RETORNA A PAGINAÇÃO
        return $this->pag;      
        
    }


    //Monta a SQL conforme os parâmetros passados por $options['named_params']
    //que vem lá do controller, executa a query e retorna a paginação
    public function getPessoasPag3(){ 
        $page = 1;
        $options = array(  
            'url'        => 'http://www.mysite.com/mypage.php?page=*VAR*', 
            'using_bound_params' => true  
        );  
          
          
        /* 
         * Call the class, the var's are: 
         * 
         * pagination(int $surrent_page, string $query, array $options) 
         */  
        try
        {
            $pagination = new Pagination($page, 'SELECT * FROM pessoa WHERE pessoaNome = :pessoaNome', $options);  
        }
        catch(paginationException $e)
        {
            echo $e;
            exit();
        }

        $pagination->bindParam(':pessoaNome', 'Pessoa 01', PDO::PARAM_STR, 12);
        $pagination->execute();
        $teste = $pagination->resultset->fetchAll(); 
        var_dump($teste);
          
          
        /* 
         * If all was successful, we can do something with our results 
         */  
        if($pagination->success == true)  
        {  
            /* 
             * Get the results 
             */  
            $result = $pagination->resultset->fetchAll();  
              
            foreach($result as $row)  
            {  
                echo '<p>'.$row['some_column'].'</p>';  
            }  
              
              
            /* 
             * Show the paginationd links ( 1 2 3 4 5 6 7 ) etc. 
             */  
            echo $pagination->links_html;  
              
              
            /* 
             * Get the total number if pages if you like 
             */  
            echo $pagination->total_pages;  
              
              
            /* 
             * Get the total number of results if you like 
             */  
            echo $pagination->total_results;  
        } 
    }



    
    
}
?>