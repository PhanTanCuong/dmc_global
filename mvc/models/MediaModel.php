<?php
    class MediaModel extends DB{
        //get List of news function
        public function getNews(){
            $query = "SELECT * FROM news";
            $result = mysqli_query($this->connection, $query);
            
            // Check for query execution error
            if (!$result) {
                die('Query failed: ' . mysqli_error($this->connection));
            }

            return $result;
        }

        //add new news function
        public function addNews($title= null,$description=null,$link=null,$image=null){
            try{
                $title=$this->connection->real_escape_string($title);
                $description=$this->connection->real_escape_string($description);
                $link=$this->connection->real_escape_string($link);
                $image=$this->connection->real_escape_string($image);           
                $query= "INSERT INTO news (title,description,link,image) VALUES ('$title','$description','$link','$image')";

                return mysqli_query($this->connection, $query);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
                
                
        }
    }
?>