<?php

use Core\DB;
class SliderModel extends DB
{
    // banner
    public function getInforBanner()
    {
        try {
            $id = 2;
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
  
}
