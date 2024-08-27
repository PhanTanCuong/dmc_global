<?php

use Core\DB;
class SliderModel extends DB
{
    // banner
    public function getInforBanner($id)
    {
        try {
            $query = "SELECT * FROM banner WHERE product_category_id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addInoforbanner($title,$description,$image,$product_category_id){
        try{
            $query="INSERT INTO banner (title,description,image,product_category_id) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $title, $description, $image, $product_category_id);
            $stmt->execute();
            return $stmt;
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }

    }
    public function customizeInforBanner($id,$title, $description, $image)
    {
        try {
            $query = "UPDATE banner SET title=?,description=?,image=? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $title, $description, $image, $id);
            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteInforBanner($id){
        try{
            $query="DELETE FROM banner WHERE id='$id'";
            return mysqli_query($this->connection,$query);
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
    public function getCurrentBannerImages($id)
    {
        try {
            $query = "SELECT image FROM banner WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
  
}
