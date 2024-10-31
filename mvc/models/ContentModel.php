<?php
namespace Mvc\Model;

use Core\DB;
class ContentModel extends DB{
    public function addContent($block_id,$type,$data,$container,$item){
        try{
            $query="INSERT INTO content (block_id,type,data,container,item) VALUES (?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("isssi",$block_id,$type,$data,$container,$item);
            return $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }

    public function getContentByBlockId($block_id){
        try{
            $query ="SELECT * FROM content WHERE block_id=?";
            $stmt= $this->connection->prepare($query);
            $stmt->bind_param("i",$block_id);
            $stmt->execute();
            return $stmt->get_result();
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }
}
?>