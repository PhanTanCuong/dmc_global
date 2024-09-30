<?php

use Core\DB;

class BackgroundModel extends DB
{
    public function getInforBackground()
    {
        try {
            $query = "SELECT * FROM background";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addBackgroundImages($image)
    {
        try {
            $query = "INSERT INTO background (image) VALUES (?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $image);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function getBackgroundById($id){
        try {
            $query = "SELECT * FROM background WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforBackground($id, $image)
    {
        try {
            $query = "UPDATE icon SET image=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $image, $id);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentBackgroundImages($id)
    {
        try {
            $query = "SELECT image FROM background WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteBackground($id){
        try{
            $query = "UPDATE background SET image='' WHERE id='$id'";
          return $this->connection->query($query);
        }catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
