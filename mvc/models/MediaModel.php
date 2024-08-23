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
    public function addNews($title, $description, $image)
    {
        try {

            $query = "INSERT INTO news (title,description,image,visible) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $visible = 0;
            $stmt->bind_param("sssi", $title, $description, $image, $visible);
            $stmt->execute();
            return $stmt;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit news function
    public function editNews($id, $title, $description, $image)
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
