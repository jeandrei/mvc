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

       

        public function edit($id){            
            if(isset($id)){
                $data = $this->modalModel->getPessoaById($id);                
                echo json_encode($data);
            } else {
                $data['status']=200;
                $data['message']="Invalid or data not found";
            }
        }


        public function update($id){
                      
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                unset($data);
                $data = [
                    'pessoaId'              => $id,   
                    'updatePessoaNome'            => html($_POST['updatePessoaNome']),
                    'updatePessoaEmail'           => html($_POST['updatePessoaEmail']),
                    'updatePessoaTelefone'        => html($_POST['updatePessoaTelefone']),
                    'updatePessoaCelular'         => html($_POST['updatePessoaCelular']),
                    'updatePessoaMunicipio'       => html($_POST['updatePessoaMunicipio']),
                    'updateBairroId'              => html($_POST['updateBairroId']),
                    'updatePessoaLogradouro'      => html($_POST['updatePessoaLogradouro']),'updatePessoaUf'              => html($_POST['updatePessoaUf']),
                    'updatePessoaNascimento'      => html($_POST['updatePessoaNascimento']), 
                    'updatePessoaCpf'             => html($_POST['updatePessoaCpf'])
                ];
                
                 //valida pessoaNome              
                 $error['updatePessoaNome'] = validate($data['updatePessoaNome'],['required',['isstring','min'=>10]]);
                 
                //valida pessoaEmail
                $error['updatePessoaEmail'] = validate($data['updatePessoaEmail'],['required','email']);
                
                //valida pessoaTelefone
                $error['updatePessoaTelefone'] = validate($data['updatePessoaTelefone'],['required','phone']);
              
                //valida pessoaCelular
                $error['updatePessoaCelular'] = validate($data['updatePessoaCelular'],['required','cphone']);
                
                //valida pessoaMunicipio
                $error['updatePessoaMunicipio'] = validate($data['updatePessoaMunicipio'],['required',['isstring','min'=>3]]);

                //valida bairroId
                $error['updateBairroId'] = validate($data['updateBairroId'],['required']);
              
                //valida pessoaLogradouro
                $error['updatePessoaLogradouro'] = validate($data['updatePessoaLogradouro'],['required',['isstring','min'=>3]]);

                //valida pessoaUf
                $error['updatePessoaUf'] = validate($data['updatePessoaUf'],['required']);
            
                //valida pessoaNascimento
                $error['updatePessoaNascimento'] = validate($data['updatePessoaNascimento'],['required',['date','min'=>18,'futuredate'=>false]]);
                
                //valida pessoaCpf
                $error['updatePessoaCpf'] = validate($data['updatePessoaCpf'],['required','cpf']);       
                
                
                 if(
                    empty($error['updatePessoaNome']) &&
                    empty($error['updatePessoaEmail']) &&
                    empty($error['updatePessoaTelefone']) &&
                    empty($error['updatePessoaCelular']) &&
                    empty($error['updatePessoaMunicipio']) &&
                    empty($error['updateBairroId']) &&
                    empty($error['updatePessoaLogradouro']) &&
                    empty($error['updatePessoaUf']) &&
                    empty($error['updatePessoaNascimento']) &&
                    empty($error['updatePessoaCpf'])
                   ){
                        try {                      
                            if($this->modalModel->update($data)){
                                $json_ret = array(
                                    'classe'=>'alert alert-success', 
                                    'message'=>'Dados gravados com sucesso',
                                    'error'=>false
                                ); 
                                echo json_encode($json_ret); 
                            }

                        } catch (Exception $e) {
                            $json_ret = array(
                                'classe'=>'alert alert-danger', 
                                'message'=>'Erro ao gravar os dados',
                                'e' => $e,
                                'error'=>$error
                                );                     
                                echo json_encode($json_ret); 
                        }                  
                   } else {
                    $json_ret = array(
                        'classe'=>'alert alert-danger', 
                        'message'=>'Erro ao tentar gravar os dados',
                        'error'=>$error
                    );
                    echo json_encode($json_ret);
                   }                
            }
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
                    $html .= '<tr class="text-center">
                              <th scope="row">
                              '.$i.'
                              </th>
                             ';
                    $html .='
                            <td>'.$pessoa->pessoaNome.'</td>
                            <td>'.$pessoa->pessoaNascimento.'</td>
                            <td>'.$pessoa->pessoaMunicipio.'</td>
                            <td>'.$pessoa->pessoaLogradouro.'</td>
                            <td>
                                <input 
                                type="text" 
                                class="form-control"
                                name="observacao"
                                onkeyup=update(this.id,this.value)                             
                                id='.$pessoa->pessoaId.'
                                value='.$pessoa->pessoaObservacao.'                         
                                >
                                <span id='.$pessoa->pessoaId.'_msg>
                            </td>
                            <td>'.$pessoa->pessoaPCD.'</td>
                            <td colspan="2">
                            <button class="btn btn-primary" 
                            onclick=edit('.$pessoa->pessoaId.')>Editar</button>
                            </td>
                            <td colspan="2">
                            <button class="btn btn-danger" 
                            onclick=excluir('.$pessoa->pessoaId.')>Excluir</button>
                            </td>
                            </tr>';

                }
            }
        
        echo $html; 
        }


        public function search(){            
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
            if($pessoas = $this->modalModel->search($_GET['nome'],$_GET['municipio'])){               
                $i = 0;
                foreach($pessoas as $pessoa){
                    $i++;
                    $html .= '<tr class="text-center">
                              <th scope="row">
                              '.$i.'
                              </th>
                             ';
                    $html .='
                            <td>'.$pessoa->pessoaNome.'</td>
                            <td>'.$pessoa->pessoaNascimento.'</td>
                            <td>'.$pessoa->pessoaMunicipio.'</td>
                            <td>'.$pessoa->pessoaLogradouro.'</td>
                            <td>
                                <input 
                                type="text" 
                                class="form-control"
                                name="observacao"
                                onkeyup=update(this.id,this.value)                             
                                id='.$pessoa->pessoaId.'
                                value='.$pessoa->pessoaObservacao.'                         
                                >
                                <span id='.$pessoa->pessoaId.'_msg>
                            </td>
                            <td>'.$pessoa->pessoaPCD.'</td>
                            <td colspan="2">
                            <button class="btn btn-primary" 
                            onclick=edit('.$pessoa->pessoaId.')>Editar</button>
                            </td>
                            <td colspan="2">
                            <button class="btn btn-danger" 
                            onclick=excluir('.$pessoa->pessoaId.')>Excluir</button>
                            </td>
                            </tr>';

                }
            } else {
                $html .= '<tr>
                            <td colspan="9" class="text-center">
                                Nenhum resultado encontrado
                            </td>
                         </tr>';                
            }
        
        echo $html; 
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                unset($data);
                $data = [     
                    'pessoaNome'            => html($_POST['pessoaNome']),
                    'pessoaEmail'           => html($_POST['pessoaEmail']),
                    'pessoaTelefone'        => html($_POST['pessoaTelefone']),
                    'pessoaCelular'         => html($_POST['pessoaCelular']),
                    'pessoaMunicipio'       => html($_POST['pessoaMunicipio']),
                    'bairroId'              => html($_POST['bairroId']),
                    'pessoaLogradouro'      => html($_POST['pessoaLogradouro']),
                    'pessoaNumero'          => html($_POST['pessoaNumero']),
                    'pessoaUf'              => html($_POST['pessoaUf']),
                    'pessoaNascimento'      => html($_POST['pessoaNascimento']), 
                    'pessoaCpf'             => html($_POST['pessoaCpf'])
                ];

                 //valida pessoaNome              
                 $error['pessoaNome'] = validate($data['pessoaNome'],['required',['isstring','min'=>10]]);
                 
                //valida pessoaEmail
                $error['pessoaEmail'] = validate($data['pessoaEmail'],['required','email']);
                
                //valida pessoaTelefone
                $error['pessoaTelefone'] = validate($data['pessoaTelefone'],['required','phone']);
              
                //valida pessoaCelular
                $error['pessoaCelular'] = validate($data['pessoaCelular'],['required','cphone']);
                
                //valida pessoaMunicipio
                $error['pessoaMunicipio'] = validate($data['pessoaMunicipio'],['required',['isstring','min'=>3]]);

                //valida bairroId
                $error['bairroId'] = validate($data['bairroId'],['required']);
              
                //valida pessoaLogradouro
                $error['pessoaLogradouro'] = validate($data['pessoaLogradouro'],['required',['isstring','min'=>3]]);

                //valida pessoaUf
                $error['pessoaUf'] = validate($data['pessoaUf'],['required']);
            
                //valida pessoaNascimento
                $error['pessoaNascimento'] = validate($data['pessoaNascimento'],['required',['date','min'=>18,'futuredate'=>false]]);
                
                //valida pessoaCpf
                $error['pessoaCpf'] = validate($data['pessoaCpf'],['required','cpf']);       

                 if(
                    empty($error['pessoaNome']) &&
                    empty($error['pessoaEmail']) &&
                    empty($error['pessoaTelefone']) &&
                    empty($error['pessoaCelular']) &&
                    empty($error['pessoaMunicipio']) &&
                    empty($error['bairroId_err']) &&
                    empty($error['pessoaLogradouro']) &&
                    empty($error['pessoaUf']) &&
                    empty($error['pessoaNascimento']) &&
                    empty($error['pessoaCpf'])
                   ){
                        try {
                            if($this->modalModel->register($data)){
                                $json_ret = array(
                                    'classe'=>'alert alert-success', 
                                    'message'=>'Dados gravados com sucesso',
                                    'error'=>false
                                ); 
                                echo json_encode($json_ret); 
                            }

                        } catch (Exception $e) {
                            $json_ret = array(
                                'classe'=>'alert alert-danger', 
                                'message'=>'Erro ao gravar os dados',
                                'e' => $e,
                                'error'=>$error
                                );                     
                                echo json_encode($json_ret); 
                        }                  
                   } else {
                    $json_ret = array(
                        'classe'=>'alert alert-danger', 
                        'message'=>'Erro ao tentar gravar os dados',
                        'error'=>$error
                    );
                    echo json_encode($json_ret);
                   }                
            }
        }

        public function delete($id){
            if(isset($id)){
                $this->modalModel->delete($id);
            }
        }


        public function getBairros(){
            try {
                if($bairros = $this->bairroModel->getBairros()){                
                    echo json_encode($bairros);
                }
            } catch (Exception $e) {
                $json_ret = array(
                    'classe'=>'alert alert-danger', 
                    'message'=>'Erro ao tentar recuperar os bairros',
                    'error'=>true
                );
                echo json_encode($json_ret);
            }            
            
        }

        


}   
  
?>