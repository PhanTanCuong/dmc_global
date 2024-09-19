<?php
 use Core\DB;

 class MenuModel extends DB{
    public function addMenu($slug,$type,$preference_id){
        try{
            $query ="INSERT INTO menu (slug,type,preference_id) VALUES(?,?,?)";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("ssi",$slug,$type,$preference_id);
            $stmt->execute();
            return $stmt->get_result();
        }catch(mysqli_sql_exception $e){
            echo "Error". $e->getMessage();
        }
    }
 }

?>