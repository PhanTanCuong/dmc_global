<?php

use Core\DB;

class IconsModel extends DB
{
    public function getInforIcons()
    {
        try {
            $query = "SELECT * FROM icon
                        WHERE block_id = 7
                        AND image <> 'footer.png'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addIconsImages($image)
    {
        try {
            
            $query = "INSERT INTO icon (block_id,image) VALUES (7,'$image')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function getIconsById($id){
        try {
            $query = "SELECT * FROM icon WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforIcons($id, $image)
    {
        try {
            $query = "UPDATE icon SET image='$image' WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCurrentIconsImages($id)
    {
        try {
            $query = "SELECT image FROM icon WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteIcons($id){
        try{
            if($id==16){
                $query = "UPDATE icon SET image='' WHERE id='$id'";
            }else{
                $query = "DELETE FROM icon WHERE id='$id'";
            }
            return mysqli_query($this->connection, $query);
        }catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
