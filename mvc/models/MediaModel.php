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

    public function getNewsbyId(int $id)
    {
        try {
            $query = "SELECT * FROM news WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //add new news function
    public function addNews($title, $short_description, $long_description, $slug, $image,$meta_description,$meta_keyword,$category_id,$type_id)
    {
        try {

            $query = "INSERT INTO news (title,description,long_description,slug,image,meta_description,meta_keyword,category_id,type_id) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssssssii",$title, $short_description, $long_description, $slug, $image, $meta_description,$meta_keyword,$category_id,$type_id);
            if ($stmt->execute()) {
                return $this->connection->insert_id;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit news function
    public function editNews($id, $title, $short_description, $long_description, $image, $meta_description, $meta_keyword,$category_id)
    {
        try {

            $query = "UPDATE news SET title=?, description=?,long_description=?,image=?,meta_description=?,meta_keyword=?,category_id=? WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssssssii", $title, $short_description, $long_description, $image, $meta_description, $meta_keyword,$category_id, $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

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
