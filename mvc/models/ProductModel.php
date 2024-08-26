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

    //get product information by id

    public function getProductbyId($id)
    {
        $query_run = "SELECT * FROM product where id='$id'";
        return mysqli_query($this->connection, $query_run);
    }


    //add new product function
    public function addProduct($title, $description, $image, $visible)
    {
        try {
            $query = "INSERT INTO product (title, description,  image, visible) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $visible = 0;
            $stmt->bind_param("sssi", $title, $description, $image, $visible);
            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit product function
    public function editProduct($id, $title, $description, $image)
    {
        try {
            $query = "UPDATE product SET title=?, description=?, image=? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sss", $title, $description, $image);
            $stmt->execute();
            return $stmt;
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
            $query = "INSERT INTO product_category (type) VALUES ('?')";
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
