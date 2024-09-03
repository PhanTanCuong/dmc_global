<?php

use Core\DB;

class CategoryModel extends DB
{
    //Product Category
    public function getInforProductCategory()
    {
        try {
            $query = "SELECT * FROM product_category";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addProductCategoryInfor($name)
    {
        try {
            $query = "INSERT INTO product_category (type) VALUES (?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getProductCategoryById($id)
    {
        try {
            $query = "SELECT * FROM product_category WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforProductCategory($id, $name)
    {
        try {
            $query = "UPDATE product_category SET type=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $name,$id);
            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteProductCategory($id)
    {
        try {
            $query = "DELETE FROM product_category WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

?>