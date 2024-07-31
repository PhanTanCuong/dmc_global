<?php
class MediaModel extends DB
{
    // Media1
    public function getNews1()
    {
        try {
            $id = 1;
            $query = "SELECT * FROM news1 WHERE id ='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    // background
    public function editBackgroundMedia1($image)
    {
        try {
            $id = 1;
            $query = "UPDATE news1 SET image='$image' WHERE id ='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentBackgroundMedia1()
    {
        try {
            $id = 1;
            $query = "SELECT image FROM news1 WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    // Icons
    public function saveIconMeida1($name, $value, $image)
    {
        try {
            $query = "INSERT INTO icon_media (name,value,image) VALUES ('$name','$value','$image')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getIconMedia1()
    {
        try {
            $query = "SELECT * FROM icon_media";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateIconMedia1($id, $name, $value, $image)
    {
        try {
            $query = "UPDATE icon_media SET name='$name', value='$value', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteIconMedia1($id)
    {
        try {
            $query = "DELETE FROM icon_media WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    //multiple delete icon_medias functions
    //toggleCheckboxDelete()
    public function toggleCheckboxDelete($id = null,$visible = null)
    {
        try {
            $query="UPDATE icon_media SET visible='$visible' WHERE id ='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteProduct()
    public function multipleDeleteStateIcon(){
        try{
            $id=1;
            $query= "DELETE FROM icon_media WHERE visible='$id'";
            return mysqli_query($this->connection, $query);
        }catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    // Media2
    //get List of news function
    public function getNews()
    {
        $query = "SELECT * FROM news";
        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }

    public function getNewsbyId($id = null)
    {
        try {
            $query = "SELECT * FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //add new news function
    public function addNews($title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);
            $query = "INSERT INTO news (title,description,link,image) VALUES ('$title','$description','$link','$image')";

            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit news function
    public function editNews($id = null, $title = null, $description = null, $link = null, $image = null)
    {
        try {
            $title = $this->connection->real_escape_string($title);
            $description = $this->connection->real_escape_string($description);
            $link = $this->connection->real_escape_string($link);
            $image = $this->connection->real_escape_string($image);

            $query = "UPDATE  news SET title='$title', description='$description', link='$link', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentNewsImages($id = null)
    {
        try {
            $query = "SELECT image FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete news function
    public function deleteNews($id = null)
    {
        try {
            $query_run = "DELETE FROM news WHERE id='$id'";
            return mysqli_query($this->connection, $query_run);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

  
}
