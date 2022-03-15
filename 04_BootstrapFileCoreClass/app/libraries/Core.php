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
        $this->getUrl();
    }

    public function getUrl(){
        echo 'This is your url ' . $_GET['url'] . '<br>';
    }

}



?>
Hello from Core
<br>