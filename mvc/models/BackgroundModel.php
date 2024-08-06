<?php

use Core\DB;

class BackgroundModel extends DB
{
    public function getInforBackground()
    {
        try {
            $query = "SELECT * FROM background";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addBackgroundImages($image)
    {
        try {
            $query = "INSERT INTO background (image) VALUES ('$image')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function getBackgroundById($id){
        try {
            $query = "SELECT * FROM background WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforBackground($id, $image)
    {
        try {
            $query = "UPDATE background SET image='$image' WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentBackgroundImages($id)
    {
        try {
            $query = "SELECT image FROM background WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteBackground($id){
        try{
            $query = "UPDATE background SET image='' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        }catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
