<?php
    class CustomModel extends DB {


        // Navigation bar
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

        public function deleteInforNavbar($id){
            try{
                $query= "DELETE FROM navbar WHERE id='$id'";
                return mysqli_query($this->connection, $query);
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
            }
        }

        public function updateInforNavbar($id, $name){
            try{
                $query= "UPDATE navbar SET name='$name' WHERE id='$id' ";
                return mysqli_query($this->connection, $query);
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
            }
        }

        // footer

        public function getFooterInfor(){
            try{
                $query= "SELECT * FROM footer";
                return mysqli_query($this->connection, $query);
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
            }
        }
    }
?>