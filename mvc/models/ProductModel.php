<?php

use Core\DB;

class ProductModel extends DB
{
    // Product 1

    //get List of products function
    public function getProduct()
    {
        try {
            $query = "SELECT * FROM product";
            return mysqli_query($this->connection, $query);

        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getRelatedProducts(){
        try{
            $query="SELECT * FROM product LIMIT 6";
            return $this->connection->query($query);
        }catch(mysqli_sql_exception $e) {
            echo "Error: ". $e->getMessage();

        }
    }
    public function getProductByProductCategory($category_id) {
        try{
            $query="SELECT * FROM product WHERE category_id = ?";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            return ($stmt->execute())?$stmt->get_result() : false;
        }catch(mysqli_sql_exception $e) {
            echo "Error: ". $e->getMessage();
        }
    }
    //get product information by id

    public function getProductbyId($id)
    {
        $query_run = "SELECT * FROM product where id='$id'";
        return mysqli_query($this->connection, $query_run);
    }


    //add new product function
    public function addProduct(
        $title,
        $short_description,
        $long_description,
        $slug,
        $image,
        $meta_description,
        $meta_keyword,
        $category_id,
        $type_id
    ) {
        try {

            $query = "INSERT INTO product 
                                        (title,description,long_description,slug,image,meta_description,meta_keyword,category_id,type_id) 
                                    VALUES 
                                        (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param(
                "sssssssii",
                $title,
                $short_description,
                $long_description,
                $slug,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
                $type_id
            );
            return ($stmt->execute()) ? $this->connection->insert_id : false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit product function
    public function editProduct(
        $id,
        $title,
        $short_description,
        $long_description,
        $image,
        $meta_description,
        $meta_keyword,
        $category_id
    ) {
        try {

            $query = "UPDATE product 
                                SET 
                                    title = ?, 
                                    description = ?, 
                                    long_description = ?, 
                                    image = ?, 
                                    meta_description = ?, 
                                    meta_keyword = ?, 
                                    category_id = ? 
                                WHERE 
                                    id = ?;
                                ";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param(
                "ssssssii",
                $title,
                $short_description,
                $long_description,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
                $id
            );
            return ($stmt->execute()) ? true : false;

        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentProductImages($id)
    {
        try {
            $query = "SELECT image FROM product WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete product function
    public function deleteProduct($id)
    {
        try {
            $query_run = "DELETE FROM product WHERE id='$id'";
            return mysqli_query($this->connection, $query_run);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //multiple delete products functions
    //toggleCheckboxDelete()
    public function toggleCheckboxDelete($id, $visible)
    {
        try {
            $query = "UPDATE product SET visible='$visible' WHERE id ='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteProduct()
    public function multipleDeleteProduct()
    {
        try {
            $query = "DELETE FROM product WHERE visible=1";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


}
