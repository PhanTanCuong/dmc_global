<?php 
class Account extends DB{
    public function getAccount(){
        $query_run="SELECT * FROM register";
        return mysqli_query($this->connection,$query_run);
    }
}
?>