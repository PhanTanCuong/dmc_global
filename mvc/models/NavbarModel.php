<?php
    class NavbarModel extends DB {

        public function getInforNavbar(){
            try{
            $query="SELECT * FROM navbar";
            return mysqli_query($this->connection, $query); 
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
            }
        }

    }
?>