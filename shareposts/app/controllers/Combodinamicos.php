<?php 
    class Combodinamicos extends Controller{
        public function __construct(){            
            $this->comboModel = $this->model('Combodinamico');
        }

        public function index(){ 
            $data = [
                "regioes" => $this->comboModel->getRegioes()
            ];
            
            $this->view('combodinamicos/index',$data);
        }

        //RETORNA O CÓDIGO PARA ADICIONAR NO SELECT DE ESTADOS
        public function estadosRegiao($idRegiao){      
            /**
             * IMPORTANTE o echo dado aqui na função é retornado no arquivo index
             * no jquery load $('#estadoId').load(
             */

            //Pego os estados da região através do métdodo
            $data = $this->comboModel->getEstadosRegiaoById($idRegiao);                      

            //O método getEstadosRegiaoById retorna false se não tiver nenhum registro no bd
            //dessa forma se retornar falso imprimo sem estados para a região
            if(!$data){
                die("<option>Sem estados para esta região</option>");
            }

           /**
            * Esse priemeiro option é para sempre adicionar no início do select, caso contário 
            * Ele vai sepmpre pegar o primeiro valor que tiver no option no caso o primeiro estado
            */
            echo ("<option>Escolha um Estado</option>");

            //Faz o foreach para cada estado dentro do array $data
            //O que for dado echo vai ser retornado lá para o index no jquery $('#estadoId').load(
            foreach($data as $row){
                echo "<option value=".$row->estadoId.">".$row->estado."</option>";
            }
        }


        //RETORNA O CÓDIGO PARA ADICIONAR NO SELECT MUNICÍPIOS
        public function municipiosEstado($idRegiao){      
            
            $data = $this->comboModel->getMunicipiosEstadoById($idRegiao);  
            
            if(!$data){
                die("<option>Sem municípios para este estado</option>");
            }
          
            echo ("<option>Escolha um Município</option>");
           
            foreach($data as $row){
                echo "<option value=".$row->municipioId.">".$row->municipio."</option>";
            }
        }

        public function add(){
            $this->view('cadastros/add');
        }

        public function edit(){            
            $this->view('cadastros/edit');
        }       
    }
?>