<?php
/**
 * App Core Class
 * Creates URL and loads core controller
 * URL FORMAT - /controller/method/params
 * The method getUrl is executed as soon as the app
 * is loded becaus app/public/index.php is loded
 * tehn it instantiate classe Core
 * Classe Core execute __construtc that
 * runs getUrl
 * getUrl gets the url from $_GET method
 * and then echo in the browser
 */
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();

        // Look in controller for first value
        // verificamos se o controller existe dentro da pasta app/controllers
        if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
        //if existe, set as a controller
        $this->currentController = ucwords($url[0]);
        // Unset 0 index
        unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        // o que vai acontecer aqui é instanciar o controller
        // exemplo $pages = new Pages;
        $this->currentController = new $this->currentController;
    }

    public function getUrl(){
        if(isset($_GET['url'])){
          //rtrim vai tirar a / do final se existir uma
          $url = rtrim($_GET['url'], '/');
          //valida a url FILTER_SANITIZE_URL não deixa passar
          // nenhum caractere que uma url não deve ter 
          $url = filter_var($url, FILTER_SANITIZE_URL);
          //quebramos a url em um array na /
          $url = explode('/', $url);
          //Assim vai retornar por exemplo /users/edit/1
          //vai passar um array {[0]=>users, [1]=>edit, [2]=>1}
          return $url;
        }
     }

}
