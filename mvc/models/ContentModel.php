<?php
use Core\DB;
class ContentModel extends DB{
    public function addContent($block_id,$type,$data,$container,$item){
        try{
            $query="INSERT INTO content (block_id,type,data,container,item) VALUES (?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("isssi",$block_id,$type,$data,$container,$item);
            return $stmt->execute();
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
}
?>