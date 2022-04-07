<?php 
    class Ajaxs extends Controller{
        public function __construct(){            
            $this->ajaxModel = $this->model('Ajax');
        }

        public function index(){  
            $this->view('ajaxs/index');
        }
        
        public function gravar(){
             $data=[
                'pessoaNome'=>$_POST['pessoaNome'],
                'pessoaEmail'=>$_POST['pessoaEmail'],
                'pessoaTelefone'=>$_POST['pessoaTelefone'],
                'pessoaCelular'=>$_POST['pessoaCelular'],
                'pessoaMunicipio'=>$_POST['pessoaMunicipio']
            ];

            $error=[];

            //valida pessoaNome
            if(empty($data['pessoaNome'])){
                $error['pessoaNome_err'] = 'Por favor informe o nome da pessoa!';
            }

            if(!empty($error['pessoaNome_err'])){
                $json_ret = array(
                                    'classe'=>'alert alert-danger', 
                                    'mensagem'=>'Erro ao tentar gravar os dados',
                                    'error'=>$error
                                );
                echo json_encode($json_ret);
                exit() ;
            }



            try{

                if($this->ajaxModel->gravaPessoa($data)){
                    $json_ret = array(
                                        'classe'=>'alert alert-success', 
                                        'mensagem'=>'Dados gravados com sucesso',
                                        'error'=>$data
                                    );                     
                    
                    echo json_encode($json_ret); 
                } else {
                    $json_ret = array(
                            'classe'=>'alert alert-danger', 
                            'mensagem'=>'Erro ao tentar gravar os dados',
                            'error'=>$data
                            );
                    echo json_encode($json_ret); 
                } 

            } catch (Exception $e) {
                $json_ret = array(
                        'classe'=>'alert alert-danger', 
                        'mensagem'=>'Erro ao gravar os dados',
                        'error'=>$data
                        );                     
                echo json_encode($json_ret); 
            }


           

                                
        }

        public function add(){
            $this->view('ajaxs/add');
        }

        public function edit(){            
            $this->view('ajaxs/edit');
        }       
    }
?>