<?php
namespace Mvc\Model;

use Core\DB;

class ProductModel extends DB
{
    // Product 1

    //get List of products function
    public function getProduct()
    {
        try {
            $query = "SELECT * FROM product";
            return $this->connection->query($query);

        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllProduct()
    {
        $query = "SELECT title, description,slug,image FROM product";
        return $this->connection->query($query);
    }

    public function getRelatedProducts()
    {
        try {
            $query = "SELECT * FROM product LIMIT 6";
            return $this->connection->query($query);
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();

        }
    }
    public function getProductByProductCategory($category_id)
    {
        try {
            $query = "SELECT * FROM product WHERE type_id = ? LIMIT 6";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            return ($stmt->execute()) ? $stmt->get_result() : false;
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //get product information by id

    public function getProductbyId($id)
    {
        try {
            $query = "SELECT * FROM product where id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            // dd($stmt->get_result());
            return $stmt->get_result()->fetch_assoc();
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
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
    ) {
        try {

            $query = "INSERT INTO product 
                                        (title,description,long_description,slug,image,meta_description,meta_keyword,category_id) 
                                    VALUES 
                                        (?,?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param(
                "sssssssi",
                $title,
                $short_description,
                $long_description,
                $slug,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
            );
            $stmt->execute();
            return $this->connection->insert_id;
        } catch (\mysqli_sql_exception $e) {
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
        $category_id,
        $type_id
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
                                    category_id = ?,
                                    type_id =? 
                                WHERE 
                                    id = ?;
                                ";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param(
                "ssssssiii",
                $title,
                $short_description,
                $long_description,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
                $type_id,
                $id
            );
            return ($stmt->execute()) ? true : false;

        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentProductImages($id)
    {
        try {
            $query = "SELECT image FROM product WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete product function
    public function deleteProduct(int $id)
    {
        try {
            $query = "DELETE FROM product WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getTypeIdByCategory($category_id)
    {
        try {
            $query = "SELEECT *  FROM category WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                return $row['parent_id'];
            }
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //multiple delete products functions
    //toggleCheckboxDelete()
    public function toggleCheckboxDelete($id, $visible)
    {
        try {
            $query = "UPDATE product SET visible=? WHERE id =?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $visible, $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteProduct()
    public function multipleDeleteProduct()
    {
        try {
            $query = "DELETE FROM product WHERE visible=1";
            return $this->connection->query($query);
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


}
