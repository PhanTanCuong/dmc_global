<?php

use Core\DB;

class PostModel extends DB
{

    //get List of post function
    public function getNews()
    {
        try {
            $query = "SELECT * FROM post";
            return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function getNewsByProductCategory($category_id)
    {
        try {
            $query = "SELECT * FROM post WHERE category_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            return ($stmt->execute()) ? $stmt->get_result() : false;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getNewsByType($type_id)
    {
        try {
            $query = "SELECT * FROM post WHERE type_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $type_id);
            return ($stmt->execute()) ? $stmt->get_result() : false;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getNewsbyId(int $id)
    {
        try {
            $query = "SELECT * FROM post WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    //add new post function
    public function addNews(
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

            $query = "INSERT INTO post 
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
            return ($stmt->execute()) ? $this->connection->insert_id : false;
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    //edit post function
    public function editNews(
        $id,
        $title,
        $short_description,
        $long_description,
        $image,
        $meta_description,
        $meta_keyword,
        $category_id
    ) {
        try {
            $query = "UPDATE post 
                                SET 
                                    title = ?, 
                                    description = ?, 
                                    long_description = ?, 
                                    image = ?, 
                                    meta_description = ?, 
                                    meta_keyword = ?, 
                                    category_id = ? 
                                WHERE 
                                    id = ?;
                                ";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param(
                "ssssssii",
                $title,
                $short_description,
                $long_description,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
                $id
            );
            return ($stmt->execute()) ? true : false;

        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getCurrentNewsImages($id)
    {
        try {
            $query = "SELECT image FROM post WHERE id=?";
            $stmt = $this->connection->prepare($query);

            if ($stmt === false) {
                throw new Exception('Statement preparation failed: ' . $this->connection->error);
            }

            $stmt->bind_param("i", $id);
            return ($stmt->execute()) ? $stmt->get_result() : false;
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    //delete post function
    public function deleteNews($id)
    {
        try {
            $query = "DELETE FROM post WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('i', $id);

            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

}
