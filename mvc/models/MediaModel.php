<?php
class MediaModel extends DB
{
    //get List of news function
    public function getNews()
    {
        $query = "SELECT * FROM news";
        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }

    public function getNewsbyId($id=null)
    {
       try{
        $query = "SELECT * FROM news WHERE id='$id'";
        return mysqli_query($this->connection, $query);

       }catch(mysqli_sql_exception $e){
        echo $e->getMessage();
       }
    }

    //add new news function
    public function addNews($title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);
            $query = "INSERT INTO news (title,description,link,image) VALUES ('$title','$description','$link','$image')";

            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit news function
    public function editNews($id = null, $title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);

            $query = "UPDATE  news SET title='$title', description='$description', link='$link', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentNewsImages($id=null){
        try{
            $query="SELECT image FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query);

        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

     //delete news function
     public function deleteNews($id = null)
     {
         try {
             $query_run = "DELETE FROM news WHERE id='$id'";
             return mysqli_query($this->connection, $query_run);
         } catch (mysqli_sql_exception $e) {
             echo $e->getMessage();
         }
     }
 
     //multiple delete newss functions
     //toggleCheckboxDelete()
     public function toggleCheckboxDelete($id = null,$visible = null)
     {
         try {
             $query="UPDATE news SET visible='$visible' WHERE id ='$id'";
             return mysqli_query($this->connection, $query);
         } catch (mysqli_sql_exception $e) {
             echo $e->getMessage();
         }
     }
 
     //multipleDeleteNews()
     public function multipleDeleteNews(){
         try{
             $id=1;
             $query= "DELETE FROM news WHERE visible='$id'";
             return mysqli_query($this->connection, $query);
         }catch (mysqli_sql_exception $e) {
             echo $e->getMessage();
         }
     }
}
