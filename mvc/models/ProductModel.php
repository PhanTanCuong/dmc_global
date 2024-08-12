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

    public function getProductbyId($id)
    {
        $query_run = "SELECT * FROM product where id='$id'";
        return mysqli_query($this->connection, $query_run);
    }


    //add new product function
    public function addProduct($title = null, $description = null, $link = null, $image = null,$visibl=null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);
            $visible = 0;
            $query = "INSERT INTO product (title,description,link,image,visible) VALUES ('$title','$description','$link','$image',$visible)";

            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit product function
    public function editProduct($id = null, $title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);

            $query = "UPDATE  product SET title='$title', description='$description', link='$link', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentProductImages($id = null)
    {
        try {
            $query = "SELECT image FROM product WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete product function
    public function deleteProduct($id = null)
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
    public function toggleCheckboxDelete($id = null, $visible = null)
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
            $id = 1;
            $query = "DELETE FROM product WHERE visible='$id'";
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
            $query = "INSERT INTO product_category (type) VALUES ('$name')";
            return mysqli_query($this->connection, $query);
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
            $query = "UPDATE product_category SET name='$name' WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteProductCategory($id)
    {
        try {
            $query = "UPDATE product_category SET name='' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
