<?php

use Core\DB;

class MediaModel extends DB
{

    //get List of news function
    public function getNews()
    {
        try {
            $query = "SELECT * FROM news";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function getNewsbyId($id)
    {
        try {
            $query = "SELECT * FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //add new news function
    public function addNews($title, $short_description,$long_description,$slug,$image,$meta_keyword,$meta_description)
    {
        try {

            $query = "INSERT INTO news (title,description,long_description,slug,image,meta_description,meta_keyword) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            // $visible = 0;
            // $stmt->bind_param("sssssss", $title, $short_description,$long_description,$slug,$image,$meta_description,$meta_keyword);
             if ($stmt->execute([$title, $short_description,$long_description,$slug,$image,$meta_description,$meta_keyword])) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit news function
    public function editNews($id, $title, $short_description,$long_description,$slug,$image,$meta_keyword,$meta_description)
    {
        try {

            $query = "UPDATE news SET title=?, description=?,long_description=?,slug=?,image=?,meta_description=?,meta_keyword WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("isssssss", $id, $title, $short_description,$long_description,$slug,$image,$meta_description,$meta_keyword);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentNewsImages($id)
    {
        try {
            $query = "SELECT image FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete news function
    public function deleteNews($id)
    {
        try {
            $query_run = "DELETE FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query_run);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
