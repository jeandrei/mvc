<?php 
    class Datatables extends Controller{
        public function __construct(){            
            $this->dataModel = $this->model('Datatable');
        }

        public function index(){             
            
            $this->view('datatables/index');         
        }


        public function teste(){
            $teste = $_GET['teste'];

            echo json_encode($teste); 
        }

        
        
        public function datatable(){           

            $this->autoRender = false; 
             // Reading value
            $draw = $_REQUEST['draw'];
            $row = intval($_POST['start']);
            $rowperpage = intval($_POST['length']); // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            $searchArray = array();

            // Search
            $searchQuery = " ";
            if($searchValue != ''){
                $searchQuery = " AND (email LIKE :email OR 
                    first_name LIKE :first_name OR
                    last_name LIKE :last_name OR 
                    address LIKE :address ) ";
                $searchArray = array( 
                    'email'=>"%$searchValue%",
                    'first_name'=>"%$searchValue%",
                    'last_name'=>"%$searchValue%",
                    'address'=>"%$searchValue%"
                );
            }

            $totalRecords = $this->dataModel->totalRecords('pessoa');

            $totalRecordwithFilter = $this->dataModel->totalRecordwithFilter('pessoa',$searchArray);

            $empRecords = $this->dataModel->empRecords('pessoa',$searchQuery,$columnName,$columnSortOrder,$row,$rowperpage);
            //$empRecords = $this->dataModel->getAll();
       
            $data = array();

            foreach ($empRecords as $row) {
                $data[] = array(
                    "email"=>$row->pessoaEmail,
                    "first_name"=>$row->pessoaNome,
                    "last_name"=>$row->pessoaMunicipio,
                    "address"=>$row->pessoaLogradouro
                );
            }
            
            // Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );
             
            
            echo json_encode($response); 
        }








        public function add(){
            $this->view('datatables/add');
        }

        public function edit(){            
            $this->view('datatables/edit');
        }       
    }
?>