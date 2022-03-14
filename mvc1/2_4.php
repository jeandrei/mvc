<?php

class User {    
    public $name;
    public $age;

    //Constructor é um metodo que executa automaticamente
    //ao instanciar um objeto
    public function __construct($name, $age){
        echo 'constructor ran... <br>';
        echo 'Class ' . __CLASS__ . ' instantiated <br>';
        $this->name = $name;
        $this->age = $age;
    }

    //Destructor executa sempre ao final
    //executa sempre quando terminamos de usar o objeto
    //Usado para limpar dados de memória e fechar conexões
    public function __destruct(){
        echo '<br> destructor ran...';
    }
  
    public function sayHello(){
        return $this->name . ' Says Hello';
    }

}


$user1 = new User('Jean', 42);
echo $user1->name . ' is ' . $user1->age . ' yers old';
echo '<br>';
echo $user1->sayHello();
?>