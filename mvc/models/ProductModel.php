<?php
class ProductModel extends DB
{
    //get List of products function
    public function getProduct()
    {
        try {
            $query = "SELECT * FROM product";
            $result = mysqli_query($this->connection, $query);

            // Check for query execution error
            if (!$result) {
                die('Query failed: ' . mysqli_error($this->connection));
            }

            return $result;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //get product information by id

    public function getProductbyId($id){
        $query_run="SELECT * FROM product where id='$id'";
        return mysqli_query($this->connection,$query_run);
    }


    //add new product function
    public function addProduct($title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);
            $query = "INSERT INTO product (title,description,link,image) VALUES ('$title','$description','$link','$image')";

            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

     //edit product function
     public function editProduct($id=null,$title = null, $description = null, $link = null, $image = null){
        try{
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);
            
            $query = "UPDATE  product SET title='$title', description='$description', link='$link', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);


        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }
}
