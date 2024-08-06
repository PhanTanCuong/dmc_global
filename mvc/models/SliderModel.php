<?php

use Core\DB;
class SliderModel extends DB
{
    // banner
    public function getInforBanner()
    {
        try {
            $id = 1;
            $query = "SELECT * FROM banner WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeInforBanner($title, $description, $image)
    {
        try {
            $id = 1;
            $title = mysqli_real_escape_string($this->connection, $title);
            $description = mysqli_real_escape_string($this->connection, $description);
            $image = mysqli_real_escape_string($this->connection, $image);
            $query = "UPDATE banner SET title='$title',description='$description',image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentBannerImages()
    {
        try {
            $id = 1;
            $query = "SELECT image FROM banner WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    // About2
    public function getInforAbout2()
    {
        try {
            $id = 1;
            $query = "SELECT * FROM about2 WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeInforAbout2($title, $description, $image, $child_image)
    {
        try {
            $id = 1;
            $title = mysqli_real_escape_string($this->connection, $title);
            $description = mysqli_real_escape_string($this->connection, $description);
            $image = mysqli_real_escape_string($this->connection, $image);
            $child_image = mysqli_real_escape_string($this->connection, $child_image);

            $query = "UPDATE about2 SET title='$title',description='$description',image='$image'
            ,child_image='$child_image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentAbout2Images()
    {
        try {
            $id = 1;
            $query = "SELECT image,child_image FROM about2 WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    // About3
    public function getInforAbout3()
    {
        try {
            $query = "SELECT * FROM about3";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addAbout3Info($title, $description, $image)
    {
        try {
            $query = "INSERT INTO about3 (title,description,image) VALUES ('$title','$description','$image')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage() . "<br>";
        }
    }
    public function deleteInforAbout3($id)
    {
        try {
            $query = "DELETE FROM about3 WHERE id='$id' ";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage() . "<br>";
        }
    }
    public function editInforAbout3($id, $title, $description, $image)
    {
        try {
            $title = mysqli_real_escape_string($this->connection, $title);
            $description = mysqli_real_escape_string($this->connection, $description);
            $title = $this->connection;
            $query = "UPDATE about3 SET title='$title', description='$description', image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage() . "<br>";
        }
    }

    //multiple delete infor functions
    //toggleCheckboxDelete()
    public function toggleCheckboxDelete($id = null, $visible = null)
    {
        try {
            $query = "UPDATE about3 SET visible='$visible' WHERE id ='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteInforAbout3()
    public function multipleDeleteInforAbout3()
    {
        try {
            $id = 1;
            $query = "DELETE FROM about3 WHERE visible='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
