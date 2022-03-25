<?php
/**
 * PDO Database Class
 * Connect to database
 * Create prepared statemants
 * Bind values
 * Retun rows and results
 */

 class Database { 
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //toda vez que preparamos um a sql vamos usar o dbh
    private $dbh;
    private $stmt;
    private $error;

    //Tebela a ser manipulada no query builder
    private $table;

    //define a tabela a ser manipulada e estabelece a conexão com o banco de dados
    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
        
    }

    public function setConnection(){
        // Set DSN DATABASE SERVER NAME
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;       
        $options = array(
            // persistent connections increase performance checking the connection to the database
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Ceate PDO instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            //Essa linha é para impedir aparecer caracteres estranhos no lugar de acentos
            $this->dbh->exec('SET NAMES "utf8"'); 
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }



    // Prepare statement with query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values
     public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;                                 
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statemant
    public function execute(){
        return $this->stmt->execute();
    }

    //Get result set as array of objects $dados->nome
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get a single record as object $dados->nome
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }



    /*****************************SQL BUILDER************************** */

    public function insert($values){          
        //DADOS DA QUERY array_keys traz as chaves de um array
        $fields = array_keys($values);       
        //array_pad cria um array com x posições
        //caso não tenha o número de posições desejadas o array_pad
        //cria colocando o valor que queremos
        //exemplo array_pad([], 3, '?'). iria criar um array de 
        //3 posições todos com ? dentro
        //logo na linha abaixo estamos criando um array com o número
        //de posições constantes no array $field, logo se no array
        //$field tiver 3 posições irá criar um arrai com ?,?,?
        $binds = array_pad([], count($fields),'?'); 
              
        //MONTA A QUERY
        //implode pega os valores do array $fields e separa com virgula
        $query = 'INSERT INTO ' .$this->table. ' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';        
        $this->stmt = $this->dbh->prepare($query);
        //executa o insert

        try{
            $this->stmt->execute(array_values($values));
            //Retorna o id inserido
            return $this->dbh->lastInsertId();
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            return false;
        }         
       
    }
}