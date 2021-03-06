<?php
    class Pages extends Controller{
        public function __construct(){
           $this->postModel = $this->model('Post');
        }

        public function index(){  
            //chamamos o método no controller
            $posts = $this->postModel->getPosts();     

            $data = [
                'title' => 'Welcome',
                'posts' => $posts
            ];
           
            //passamos os dados para o view app\views\pages\index
            $this->view('pages/index', $data);
        }
    
        public function about(){
            $data = [
                'title' => 'About'
            ];

            $this->view('pages/about', $data);
        }
    }
?>