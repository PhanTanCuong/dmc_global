<?php
namespace Mvc\Services;
 use Core\DB;
class SidebarService extends DB{
  
    public function getSidebarData(){
        try{
            $query="SELECT * FROM sidebar_view";
            return $this->connection->query($query);
        }catch(\mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
}
?>