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
            
            
            //pega atual passada pelo get caso contrário pega o post do buscar
            $parametros=[
                "pessoaNome" => (!empty($_GET['pessoaNome'])?(($_GET['pessoaNome'])):''),
                "bairroId" => (!empty($_GET['bairroId'])?(($_GET['bairroId'])):'')               
            ];            
            $page = (!empty($_GET['page'])?(($_GET['page'])):(1));
            //aqui passo a pagina atual, os parametros do filtro tudo tem que ser igual o nome da tabela
            //e com método get, o nome da tabela e o campo que quero ordenar            
            $results = $this->pessoaModel->getPessoasPag($page,5,$parametros,'pessoa','pessoaNome');
                                
           

            
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
            $data['paginacao'] = $results['paginacao'];

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