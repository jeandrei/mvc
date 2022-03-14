<?php

//Definindo uma classe
/**
 * Uma classe é igual um projeto de uma casa
 * A partir do projeto podemos construir várias casas
 * que seriam os objetos
 * Os métodos são como funções que podem ser executadas 
 * na casa como abrir porta, abrir janela
 * 
 */
class User {
    // Propriedades (atributos)
    public $name;

    //Metodos (Funções)
    public function sayHello(){
        return $this->name . ' Says Hello';
    }

}

// Instanciamos um objeto
$user1 = new User();
$user1->name = 'Brad';
echo $user1->name;
echo '<br>';
echo $user1->sayHello();

echo '<br>';

// Create new user
$user2 = new User();
$user2->name = 'Jeff';
echo $user2->name;
echo '<br>';
echo $user2->sayHello();
?>