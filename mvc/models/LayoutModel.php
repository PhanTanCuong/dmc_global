<?php
class LayoutModel extends \Core\DB{
    public function getLayout(){
        try{
            $query="SELECT * FROM block";
            return $this->connection->query($query);
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }

    public function addLayout($name){
        try{
            $query="INSERT INTO block (name) VALUES (?)";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("s", $name);
            return $stmt->execute();
        }catch(mysqli_sql_exception $e){

        }
    }
}
?>