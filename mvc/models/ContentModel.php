<?php
use Core\DB;
class ContentModel extends DB{
    public function addContent($block_id,$type,$data,$container){
        try{
            $query="INSERT INTO content (block_id,type,data,container) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("isss",$block_id,$type,$data,$container);
            return $stmt->execute();
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
}
?>