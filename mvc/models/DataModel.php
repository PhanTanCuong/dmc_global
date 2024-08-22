<?php

use Core\DB;

class DataModel extends DB
{
    public function getItem($block_id,$page_id){
        try{
            $query = "SELECT * FROM item WHERE block_id='$block_id' AND product_category_id	='$page_id'";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }

    public function addData($title, $description, $image, $block_id, $page_id){
        try{
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $query = "INSERT INTO item (title, description, image, block_id, product_category_id) VALUES ('$title', '$description', '$image', '$block_id', '$page_id')";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){

            echo "Error: ". $e->getMessage();
        }
    }

        public function editItem($id,$title, $description, $image){
        try{
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $query = "UPDATE item SET title='$title', description='$description', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){

            echo "Error: ". $e->getMessage();
        }
    }

    public function deleteItem($id){
        try{
            $query = "DELETE FROM item WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){

            echo "Error: ". $e->getMessage();
        }
    }

    public function getItemById($id){
        try{
            $query="SELECT * FROM item WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
    //get List of datas function
    public function getData($id)
    {
        
            $query = "SELECT DISTINCT 
            background.id,
            background.image,
            background.block_id,
            data.title,
            data.description
        FROM 
            background
        RIGHT JOIN 
            data 
        ON 
            background.block_id = data.block_id
        WHERE
            background.block_id='$id'
        ";
        


        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }


    //get data infor by id
    public function getDataById($id)
    {
        $query_run = "SELECT DISTINCT 
                        background.id,
                        background.image,
                        background.block_id,
                        data.title,
                        data.description
                    FROM 
                        background
                    RIGHT JOIN 
                        data 
                    ON 
                        background.block_id = data.block_id
                    WHERE
                        background.id = '$id'";
        return mysqli_query($this->connection, $query_run);
    }



    //edit user data function
    public function editData($id, $title, $description, $image)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $image = $this->connection->real_escape_string($image);
            $query = "UPDATE data
                        JOIN 
                            background 
                        ON 
                            background.block_id = data.block_id
                        SET 
                            image = '$image',
                            data.title = '$title', 
                            data.description = '$description'
                            
                        WHERE 
                        background.id = '$id';
";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
