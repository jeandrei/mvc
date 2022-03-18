<?php 
    class Pessoas extends Controller{
        public function __construct(){            
            $this->pessoaModel = $this->model('Pessoa');
        }

        public function index(){

            //IMPEDE O ACESSO A POSTS SE NÃO ESTIVER LOGADO
            // isLoggedIn está no arquivo session_helper            
            if(!isLoggedIn()){               
                redirect('users/login');  
            }
            
            // Pego os registros do banco de dados
            $pessoas = $this->pessoaModel->getPessoas();
        
            $data = [
                'pessoas' => $pessoas
            ]; 
             
            $this->view('pessoas/index', $data);
        }

        public function add(){
            $this->view('pessoas/add');
        }

        public function edit(){
            $this->view('pessoas/edit');
        }       
    }
?>