<?php 
    class Pessoas extends Controller{
        public function __construct(){            
            $this->pessoaModel = $this->model('Pessoa');
            $this->bairroModel = $this->model('Bairro');
        }

        public function index(){

            //IMPEDE O ACESSO A POSTS SE NÃO ESTIVER LOGADO
            // isLoggedIn está no arquivo session_helper            
            if(!isLoggedIn()){               
                redirect('users/login');  
            }
            
            // Pego os registros do banco de dados
            //$results = $this->pessoaModel->getPessoas();
            //var_dump($_POST['buscar']);
            $results = $this->pessoaModel->getPessoasPag(!empty($_GET['page'])?(($_GET['page'])):(1));
           
            
            
            echo $results['paginacao'];

            
            //faço um foreach passando os dados que quero
            //essa parte é importante posis podemos executar
            //metodos aqui por exemplo em bairro ao invés de passar o id
            //podemos executar um método antes getBairroById() e passar o nome do bairro
            if(!empty($results)){
                foreach($results['results'] as $result){
                    $data['results'][]=[
                        'pessoaId' => $result->pessoaId,
                        'pessoaNome' => $result->pessoaNome,
                        'pessoaNascimento' => date('d/m/Y', strtotime($result->pessoaNascimento)),
                        'pessoaMunicipio' => $result->pessoaMunicipio,
                        'pessoaLogradouro' => $result->pessoaLogradouro,
                        'pessoaBairro' => $this->bairroModel->getBairroById($result->bairroId),
                        'pessoaDeficiencia' => ($result->pessoaDeficiencia == 0) ? 'Não' : 'Sim'
                        ];
                }
            } else {
                $data['results'] = false;
            }
            
            $data['titulo'] = "Exemplo de Cadastro";         

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