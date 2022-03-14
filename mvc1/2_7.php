<?
//Static Methods
/*
O valor de um metodo estático ou propriedade não é relativo 
a uma instancia de um objeto ou instância de uma classe
é relativo a classe em si significa que não temos que 
instanciar a classe ou o objeto para poder usar
tem certas situações em que isso é muito útil
Um exemplo é na validação de senha, a validação será
a mesma sempre logo não precisamos instanciar um objeto para usar
pois será o mesmo para todos os objetos
*/

class User {
    public $name;
    public $age;
    public static $minPassLenght = 6;

    public static function validatePass($pass){
        //por ser static temos que usar o self ao invés do this
        if(strlen($pass) >= self::$minPassLenght){
            return true;
        } else {
            return false;
        }
    }
}


$password = 'hello';
if(User::validatePass($password)){
    echo 'Password valid';    
} else {
    echo 'Passsword NOT valie';
}

?>