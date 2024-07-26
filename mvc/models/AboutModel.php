<?php
class AboutModel extends DB
{
    // About2
    public function getInforAbout2(){
        try{
            $id=1;
            $query="SELECT * FROM about2 WHERE id='$id'";
            return mysqli_query($this->connection, $query);

        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    public function customizeInforAbout2($title,$description,$image,$child_image){
        try{
            $id=1;
            $title =mysqli_real_escape_string($this->connection,$title);
            $description =mysqli_real_escape_string($this->connection,$description);
            $image =mysqli_real_escape_string($this->connection,$image);
            $child_image =mysqli_real_escape_string($this->connection,$child_image);

            $query="UPDATE about2 SET title='$title',description='$description',image='$image'
            ,child_image='$child_image' WHERE id='$id'";
            return mysqli_query($this->connection,$query);



        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    public function getCurrentAbout2Images(){
        try{
            $id=1;
            $query="SELECT image,child_image FROM about2 WHERE id='$id'";
            return mysqli_query($this->connection, $query);

        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }


}
