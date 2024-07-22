<?php 
class AccountModel extends DB{

    //get List of accounts function
    public function getAccount(){
        $query_run="SELECT * FROM register";
        return mysqli_query($this->connection,$query_run);
    }

    //get account infor by id
    public function getAccountbyId($id){
        $query_run="SELECT * FROM register where id='$id'";
        return mysqli_query($this->connection,$query_run);
    }

    public function addAccount($username,$email,$password,$role){
            //PASSWORD_BCRYPT: độ dài=60
            //PASSWORD_DEFAULT: độ dài=255
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            $query_run= "INSERT INTO register (username,email,password,role) VALUES ('$username','$email','$hash_password','$role')";
    }
}
?>