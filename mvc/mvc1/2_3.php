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
    public $name = 'Brad';

    //Metodos (Funções)
    public function sayHello(){
        return $this->name . ' Says Hello';
    }

}

// Instanciamos um objeto
$user1 = new User();

echo $user->name;

echo '<br>';

echo $user1->sayHello();
?>