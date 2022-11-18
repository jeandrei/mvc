<?php 
    class Modals extends Controller{
        public function __construct(){            
            $this->modalModel = $this->model('Modal');
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
                            'pessoaNascimento' => formatadata($row['pessoaNascimento']),
                            'pessoaMunicipio' => $row['pessoaMunicipio'],
                            'pessoaLogradouro' => $row['pessoaLogradouro'],
                            'pessoaBairro' => $this->bairroModel->getBairroById($row['bairroId']),
                            'pessoaDeficiencia' => ($row['pessoaDeficiencia'] == 'n') ? 'Não' : 'Sim',
                            'pessoaObservacao' => $row['pessoaObservacao']
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

            $this->view('modals/index', $data);
        }

        public function add(){
            $this->view('modals/add');
        }

        public function edit(){            
            $this->view('modals/edit');
        }
        
        public function pessoas(){
            
            $html = "
                <thead>
                    <tr class='text-center'>  
                    <th scope='col'>ID</th>    
                    <th scope='col'>Nome</th>
                    <th scope='col'>Nascimento</th>
                    <th scope='col'>Municipio</th>
                    <th scope='col'>Logradouro</th>
                    <th scope='col'>Observação</th>
                    <th scope='col'>PCD</th>
                    <th scope='col'>Ações</th>                         
                    </tr>
                </thead>
                <tbody>       
                ";
            if($pessoas = $this->modalModel->getPessoas()){
                $i = 0;
                foreach($pessoas as $pessoa){
                    $i++;
                    $html .= "<tr class='text-center'>
                              <th scope='row'>
                              $i
                              </th>
                             ";
                    $html .="
                            <td>$pessoa->pessoaNome</td>
                            <td>$pessoa->pessoaNascimento</td>
                            <td>$pessoa->pessoaMunicipio</td>
                            <td>$pessoa->pessoaLogradouro</td>
                            <td>
                                <input 
                                type=text 
                                class=form-control
                                name=observacao
                                onkeyup=update(this.id,this.value)
                                id='$pessoa->pessoaId'
                                value='$pessoa->pessoaObservacao'                         
                                >
                                <span id='$pessoa->pessoaId'_msg>
                            </td>
                            <td>$pessoa->pessoaPCD</td>
                            <td colspan='2'>
                            <a href='#' class='btn btn-primary'>Editar</a>
                            </td>
                            <td colspan='2'>
                            <a href='#' class='btn btn-danger'>Excluir</a>
                            </td>
                            ";

                }
            }
        
        echo $html; 
        }


        public function buscanome(){            
            $html = "
                <thead>
                    <tr class='text-center'>  
                    <th scope='col'>ID</th>    
                    <th scope='col'>Nome</th>
                    <th scope='col'>Nascimento</th>
                    <th scope='col'>Municipio</th>
                    <th scope='col'>Logradouro</th>
                    <th scope='col'>Observação</th>
                    <th scope='col'>PCD</th>
                    <th scope='col'>Ações</th>                         
                    </tr>
                </thead>
                <tbody>       
                ";
            if($pessoas = $this->modalModel->buscaNome($_GET['nome'])){
                $i = 0;
                foreach($pessoas as $pessoa){
                    $i++;
                    $html .= "<tr class='text-center'>
                              <th scope='row'>
                              $i
                              </th>
                             ";
                    $html .="
                            <td>$pessoa->pessoaNome</td>
                            <td>$pessoa->pessoaNascimento</td>
                            <td>$pessoa->pessoaMunicipio</td>
                            <td>$pessoa->pessoaLogradouro</td>
                            <td>
                                <input 
                                type=text 
                                class=form-control
                                name=observacao
                                onkeyup=update(this.id,this.value)
                                id='$pessoa->pessoaId'
                                value='$pessoa->pessoaObservacao'                         
                                >
                                <span id='$pessoa->pessoaId'_msg>
                            </td>
                            <td>$pessoa->pessoaPCD</td>
                            <td colspan='2'>
                            <a href='#' class='btn btn-primary'>Editar</a>
                            </td>
                            <td colspan='2'>
                            <a href='#' class='btn btn-danger'>Excluir</a>
                            </td>
                            ";

                }
            }
        
        echo $html; 
        }


}   
  
?>