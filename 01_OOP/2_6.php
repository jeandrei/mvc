<?php
    //Herança
    
    class User{
        protected $name = 'Brad';
        protected $age;

        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }
    }

    //Costumer tem acesso as propriedades e métodos de Users
    class Customer extends User {
        private $balance;

        public function __construct($name, $age, $balance){
            /*parent::_construct pega o valor passado na classe pai
            Para não precisar pegar os dois valores novamente
            $this->name = $name;
            $this->age = $age;
            */
            parent::__construct($name, $age);
            $this->balance = $balance;
        }

        public function pay($amount){
            return $this->name . ' paid $' . $amount;
        }

        public function getBalance(){
            return $this->balance;
        }

    }

    $costumer1 = new Customer('John', 33, 500);
    echo $costumer1->pay(100);
    echo '<br>';
    echo $costumer1->getBalance();
?>