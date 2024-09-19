<?php
 use Core\DB;

 class MenuModel extends DB{
    public function addMenu($slug,$preference_id,$category_id){
        try{
            $query ="INSERT INTO menu (slug,preference_id,category_id) VALUES(?,?,?)";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("sii",$slug,$preference_id,$category_id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(mysqli_sql_exception $e){
            echo "Error". $e->getMessage();
        }
    }

    public function deleteMenu($preference_id){
        try{
            $query="DELETE FROM menu WHERE preference_id=?";
            $stmt =$this->connection->prepare($query);
            $stmt->bind_param("i",$preference_id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(mysqli_sql_exception $e){
            echo "Error". $e->getMessage();
        }
    }

    public function updateMenu($category_id,$preference_id){
        try{
            $query="UPDATE menu SET category_id=? WHERE preference_id=?";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("ii",$category_id,$preference_id); 
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(mysqli_sql_exception $e){
            echo "Error". $e->getMessage();
        }
    }

    public function getMenuBySlug($slug){
        try{
            $query="SELECT * FROM menu WHERE slug=?";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("i",$slug);
            $stmt->execute();
            return $stmt->get_result();
        }catch(mysqli_sql_exception $e){
            echo "Error".$e->getMessage();
        }
    }
 }

?>