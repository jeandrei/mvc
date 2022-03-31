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
            
           
            /** 01
             * IMPORTANTE O MÉTODO DO FORMULÁRIO TEM QUE SER GET
             * E O **NOME DOCAMPO DE BUSCA TEM QUE SER IGUAL AO DO BANCO DE DADOS**
             * verifica a página que está passando se não tiver
             * página no get vai passar pagina 1
             */
            if(isset($_GET['page']))  
            {  
                $page = $_GET['page'];  
            }  
            else  
            {  
                $page = 1;  
            }  

            //Para permitir armazenar o número de linhas da paginação eu verifico
            //se foi passado o numRows pelo get se sim armazeno no Session para não perder
            //o valor quando clicado no link de paginação
            if(isset($_GET['numRows'])){
                $_SESSION['numRows'] = $_GET['numRows'];
            } else {
                $_SESSION['numRows'] = 10;
            }

            /** 02
             * 
             * passo o array com as opções 
             * 
             */            
            $options = array(
                'results_per_page' => ($_GET['numRows'])?($_GET['numRows']):($_SESSION['numRows']),
                'url' => URLROOT . '/pessoas/index.php?page=*VAR*&pessoaNome=' . $_GET['pessoaNome'] . $_GET['pessoaMunicipio'],
                'using_bound_params' => true,
                'named_params' => array(
                                        ':pessoaNome' => $_GET['pessoaNome'],
                                        ':pessoaMunicipio' => $_GET['pessoaMunicipio']                                  
                                    )     
            );
            
            /** 03
             * 
             * Chamo o método da paginação que está no model
             */
            $pagination = $this->pessoaModel->getPessoasPag($page,$options);           

            /** 04
             * 
             * Verifico se obteve sucesso
             */
            if($pagination->success == true){
                //Aqui passo apenas a paginação
                $data['pagination'] = $pagination; 
               
                
                //Aqui pego apenas os resultados do banco de dados
                $results = $pagination->resultset->fetchAll();
                
                
                //Monto o array data['results'][] com os resultados
                if(!empty($results)){
                    foreach($results as $row){
                        $data['results'][] = [
                            'pessoaId' => $row['pessoaId'],
                            'pessoaNome' => $row['pessoaNome'],
                            'pessoaNascimento' => date('d/m/Y', strtotime($row['pessoaNascimento'])),
                            'pessoaMunicipio' => $row['pessoaMunicipio'],
                            'pessoaLogradouro' => $row['pessoaLogradouro'],
                            'pessoaBairro' => $this->bairroModel->getBairroById($row['bairroId']),
                            'pessoaDeficiencia' => ($row['pessoaDeficiencia'] == 'n') ? 'Não' : 'Sim'                        
                        ];
                    }
                }
                     
            } else {
                $data['results'] = false;
            }
            /**
             * 05 
             * Lá no final do view eu imprimo a paginação
             * 
             */       
            
            $data['titulo'] = "Exemplo de Cadastro com Paginação";         

            $this->view('pessoas/index', $data);
        }

        public function add(){
            $data['titulo'] = "Exemplo adicionar novo";
            $data['bairros'] = $this->bairroModel->getBairros(); 
            
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //SANITIZE POST impede códigos maliciosos
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //TRATO OS DADOS SE NECESSÁRIO POSSO EXECUTAR MÉTODOS NO MODEL PARA RETORNAR VALORES
                //EXEMPLO "campoteste" => $this->model->getNome($id);
                $data = [
                    "pessoaNome"        => html($_POST['pessoaNome']),
                    "pessoaEmail"       => html($_POST['pessoaEmail']),
                    "pessoaTelefone"    => html($_POST['pessoaTelefone']),
                    "pessoaCelular"     => html($_POST['pessoaCelular']),
                    "pessoaMunicipio"   => html($_POST['pessoaMunicipio']),
                    "bairroId"          => html($_POST['bairroId']),
                    "pessoaLogradouro"  => html($_POST['pessoaLogradouro']),
                    "pessoaNumero"      => html($_POST['pessoaNumero']),
                    "pessoaUf"          => html($_POST['pessoaUf']),
                    "pessoaNascimento"  => html(date('d-m-Y',strtotime($_POST['pessoaNascimento']))),
                    "pessoaDeficiencia" => html($_POST['pessoaDeficiencia']),
                    "pessoaCpf"         => html($_POST['pessoaCpf']),
                    "pessoaCnpj"        => html($_POST['pessoaCnpj'])
                ];

                //VALIDAÇÃO PHP
                
                //valida pessoaNome
                if(empty($data['pessoaNome'])){
                    $data['pessoaNome_err'] = 'Por favor informe o nome da pessoa!';
                }

                //valida pessoaEmail
                if(empty($data['pessoaEmail'])){
                $data['pessoaEmail_err'] = 'Por favor informe o Email!';
                } else {
                    if(!validaemail($data['pessoaEmail'])){
                        $data['pessoaEmail_err'] = 'Email inválido!'; 
                    }
                }

                //valida pessoaTelefone
                if(empty($data['pessoaTelefone'])){
                    $data['pessoaTelefone_err'] = 'Por favor informe o telefone!';
                } else {
                    if(!validatelefone($data['pessoaTelefone'])){
                        $data['pessoaTelefone_err'] = 'Telefone inválido!'; 
                    }
                }

                //valida pessoaCelular
                if(empty($data['pessoaCelular'])){
                    $data['pessoaCelular_err'] = 'Por favor informe o celular!';
                }

                //valida pessoaMunicipio
                if(empty($data['pessoaMunicipio'])){
                    $data['pessoaMunicipio_err'] = 'Por favor informe o município!';
                }

                //valida bairroId
                if(empty($data['bairroId'])){
                    $data['bairroId_err'] = 'Por favor informe o bairro!';
                }

                //valida pessoaLogradouro
                if(empty($data['pessoaLogradouro'])){
                    $data['pessoaLogradouro_err'] = 'Por favor informe o logradouro!';
                }

                //valida pessoaNumero
                if(empty($data['pessoaNumero'])){
                    $data['pessoaNumero_err'] = 'Por favor informe o número!';
                }

                //valida pessoaUf
                if(empty($data['pessoaUf'])){
                    $data['pessoaUf_err'] = 'Por favor informe a Unidade Federativa!';
                }

                //valida pessoaNascimento
                if(empty($data['pessoaNascimento'])){
                    $data['pessoaNascimento_err'] = 'Por favor informe o nascimento!';
                }

                //valida pessoaDeficiencia
                if(empty($data['pessoaDeficiencia'])){
                    $data['pessoaDeficiencia_err'] = 'Por favor informe se é PCD!';
                }

                //valida pessoaCpf
                if(empty($data['pessoaCpf'])){
                    $data['pessoaCpf_err'] = 'Por favor informe o CPF!';
                }

                //valida pessoaCnpj
                if(empty($data['pessoaCnpj'])){
                    $data['pessoaCnpj_err'] = 'Por favor informe o CNPJ!';
                }

                //https://github.com/jeandrei/sisurpe/blob/master/sisurpe/app/controllers/Datausers.php



                if(
                    empty($data['pessoaNome_err'])&&
                    empty($data['pessoaEmail_err'])&&
                    empty($data['pessoaTelefone_err'])
                ){
                    //register
                } else {
                    //Validação falhou
                    flash('mensagem', 'Erro ao efetuar o cadastro, verifique os dados informados!','alert alert-danger'); 
                    $this->view('pessoas/add',$data);
                }

                //var_dump($data);
                die("você submeteu");
            }

            $this->view('pessoas/add', $data);
        }

        public function edit(){
            $this->view('pessoas/edit');
        }          
       
    }
?>