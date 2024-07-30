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

        public function addInfor2Navbar($name){
            try{
                $query= "INSERT INTO navbar (name) VALUES ('$name')";
                return mysqli_query($this->connection, $query);
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
            }
        }
    }
?>