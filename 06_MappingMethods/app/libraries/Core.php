<?php

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getUrl();

        if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
        }

        require_once '../app/controllers/' . $this->currentController . '.php';       
        $this->currentController = new $this->currentController;
        
        // Check for second part of url
        if(isset($url[1])){
          // Check to see if the method exist in the controller
          if(method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
            // Unset 0 index
            unset($url[1]);
          }
        }
        //echo 'This is the current method ' . $this->currentMethod;

        // Get params
        // se tiver valor na url ele passa para a propriedade
        // params caso contrário passa um array vazio
        $this->params = $url ? array_values($url) :[];

         

         /* Call a callback with array of params
         * cunção call_user_func_array chama a classe e o método da classe
         * exemplo imagine uma classe User com o método getUsers($idade,$sexo);
         * $user = new User;
         * call_user_func_array($user, "getUsers"), array("20", "Masculino"));
         */
         call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
          $url = rtrim($_GET['url'], '/');         
          $url = filter_var($url, FILTER_SANITIZE_URL);          
          $url = explode('/', $url);         
          return $url;
        }
     }

}
