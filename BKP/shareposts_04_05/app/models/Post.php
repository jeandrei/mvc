<?php

    class Post {
        private $db;

        
        public function __construct(){
            $this->db = new Database;
        }

        
        public function getPosts2(){
            $this->db->query('SELECT *,
                              posts.id as postId,
                              users.id as userId,
                              posts.created_at as postCreated,
                              users.created_at as userCreated
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.created_at DESC
                              ');
            $results = $this->db->resultSet(); 
            return $results;           
        }

        public function getPosts(){
            $this->db->query('SELECT *,
                              posts.id as postId,
                              users.id as userId,
                              posts.created_at as postCreated,
                              users.created_at as userCreated
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.created_at DESC
                              ');
            $posts = $this->db->resultSet();

                                   
            foreach($posts as $post){                
                $data[] = array(
                    'id'=>$post->postId,
                    'user_id'=>$post->userId,
                    'name'=>$post->name,
                    'title'=>$post->title,
                    'body'=>$post->body,
                    'created_at'=>$post->created_at,
                    'files' => $this->getFilePostById($post->postId)                  
                );
            }
                       
            return $data;           
        }


        public function addPost($data){
            $this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
            // Bind values
            $this->db->bind(':title',$data['title']);
            $this->db->bind(':user_id',$data['user_id']);
            $this->db->bind(':body',$data['body']);

            // Execute
            if($this->db->execute()){
                return  $this->db->lastId;                
            } else {
                return false;
            }
        }

        //Adiciona os arquivos na tabela file_post
        public function addFilesPost($post_id,$data){           
            
            $this->db->query('
                                INSERT INTO 
                                file_post 
                                    (
                                        post_id,
                                        title, 
                                        body, 
                                        file,
                                        file_name,
                                        file_type
                                    ) 
                                VALUES 
                                    (
                                        :post_id,
                                        :title, 
                                        :body, 
                                        :file,
                                        :file_name,
                                        :file_type
                                    )'
                                );
            $this->db->bind(':post_id',$post_id);
            $this->db->bind(':title',$data['title']);
            $this->db->bind(':body',$data['body']);
            $this->db->bind(':file',$data['file_post_data']);
            $this->db->bind(':file_name',$data['file_post_name']);
            $this->db->bind(':file_type',$data['file_post_type']);

            // Execute
            
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

        }

        public function updatePost($data){
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':title',$data['title']);            
            $this->db->bind(':body',$data['body']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function getFilePostById($id_post){
            $this->db->query('SELECT * FROM file_post WHERE post_id = :id_post');
            $this->db->bind(':id_post', $id_post);

            $result = $this->db->resultSet();
            
            //verifica se obteve algum resultado
            if($result >0)
            {
                foreach ($result as $row)
                {
                $data[] = array(  
                        'id' => $row->id,
                        'title' => $row->title,
                        'body' => $row->body,
                        'file' => $row->file,
                        'file_name' => $row->file_name,
                        'file_type' => $row->file_type
                    );
                } 
                //var_dump($data);
                return $data;
            }
            else
            {
                return false;
            }   
        }

        public function deletePost($id){
            
            $this->db->query('DELETE FROM file_post WHERE post_id = :id');
            // Bind values
            $this->db->bind(':id',$id);  

            $this->db->execute();

            $this->db->query('DELETE FROM posts WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$id);            

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }

        }
        
        public function deleteFile($id){
            /* pego o id do post para poder retornar */
            $this->db->query('SELECT post_id FROM file_post WHERE id = :id');
            $this->db->bind(':id', $id);

            $postId = $this->db->single();  

            /* removo a imagem */
            $this->db->query('DELETE FROM file_post WHERE id = :id');
            // Bind values
            $this->db->bind(':id',$id);            

            // Execute
            if($this->db->execute()){
                return $postId;
            } else {
                return false;
            }
        }
    
    }

?>