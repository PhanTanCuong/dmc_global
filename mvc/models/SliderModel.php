<?php

use Core\DB;
class SliderModel extends DB
{
    // banner
    public function getInforBanner($id)
    {
        try {
            $query = "SELECT * FROM banner WHERE product_category_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addInforbanner($title, $description, $image, $product_category_id)
    {
        try {
            $query = "INSERT INTO banner (title,description,image,product_category_id) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $title, $description, $image, $product_category_id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }
    function customizeInforBanner($id, $title, $description, $image)
    {
        try {
            $query = "UPDATE banner SET title=?,description=?,image=? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $title, $description, $image, $id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    function deleteInforBanner($id)
    {
        try {
            $query = "DELETE FROM banner WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getCurrentBannerImages($id)
    {
        try {
            $query = "SELECT image FROM banner WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getBannerInforById($id)
    {
        try {
            $query = "SELECT * FROM banner WHERE id=?";
            $stmt =$this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
