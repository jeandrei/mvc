<?php 
    class Datatables extends Controller{
        public function __construct(){            
            $this->dataModel = $this->model('Datatable');
        }

        public function index(){                                 
            $this->view('datatables/index');         
        }

        
        
        public function datatable(){           


            $data = [
                "draw" => $_POST['draw'],
                "row" => $_POST['start'],
                "rowperpage" => $_POST['length'],
                "columnIndex" => $_POST['order'][0]['column'],
                "columnName" => $_POST['columns'][$columnIndex]['data'],
                "columnSortOrder" => $_POST['order'][0]['dir'],
                "searchValue" => $_POST['search']['value']                
            ];

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

            $empRecords = $this->dataModel->empRecords('pessoa',$searchQuery,$columnName,$columnSortOrder,$data);
            
       
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