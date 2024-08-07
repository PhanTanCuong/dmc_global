<?php

use Core\DB;

class DataModel extends DB
{
    //get List of datas function
    public function getData()
    {
        $query = "SELECT * FROM data";
        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }


    //get data infor by id
    public function getDataById($id)
    {
        $query_run = "SELECT * FROM data where id='$id'";
        return mysqli_query($this->connection, $query_run);
    }

    //add user data function
    public function addData($title, $description)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $query = "INSERT INTO data (title,description) VALUES ('$title','$description')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit user data function
    public function editData($id, $title, $description)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);

            $query = "UPDATE  data SET title='$title', description='$description' WHERE id='$id'  ";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete user data function
    public function deleteData($id)
    {
        try {
            $query_run = "UPDATE data SET title='',description='' WHERE id='$id'";
            return mysqli_query($this->connection, $query_run);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
