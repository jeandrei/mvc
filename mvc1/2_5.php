<?php
//Public consegue acessar fora da classe em qualquer lugar
//Private só consegue acessar dentro da classe
//Protected consegue acessar dentro da classe e 
//também qualquer classe que estende ela

class User {    
    private $name;
    private $age;

    public function __construct($name, $age){
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    //__get MAGIC METHOD
    //com esse metodo não precisamos criar um set e get
    //para cada propriedade do objeto
    //basta chamar objeto->__get('propriedade');
    public function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }

    //__set MAGIC METHOD
    //Mesma coisa do get magic mas aqui passamos
    //a propriedade e o valor
    //objeto->__set('propriedade','valor');
    public function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
        return $this;
    }

}


$user1 = new User('Jean', 42);

//$user1->setName('Nome modificado pelo setName');
//echo $user1->getName();

$user1->__set('age', 44);

echo $user1->__get('name');
echo '<br>';
echo $user1->__get('age');
?>