<?php 
class AccountModel extends DB{

    //get List of accounts function
    public function getAccount(){
        $query = "SELECT * FROM register";
        $result = mysqli_query($this->connection, $query);
        
        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }

    //Total number of user
    public function totalUser(){
        $query="SELECT id FROM register ORDER BY id";
        $result = mysqli_query($this->connection, $query);
        
        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }
        $total=mysqli_num_rows($result);
        return $total;
    }

    //get account infor by id
    public function getAccountbyId($id){
        $query_run="SELECT * FROM register where id='$id'";
        return mysqli_query($this->connection,$query_run);
    }

    //add user account function
    public function addAccount($username= null,$email=null,$password=null,$role=null){
        try{
            $username=$this->connection->real_escape_string($username);
            $email=$this->connection->real_escape_string($email);
            $password=$this->connection->real_escape_string($password);
            $role=$this->connection->real_escape_string($role);
            //PASSWORD_BCRYPT: độ dài=60
            //PASSWORD_DEFAULT: độ dài=255
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            $query= "INSERT INTO register (username,email,password,role) VALUES ('$username','$email','$hash_password','$role')";

            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
            
    }

    //edit user account function
    public function editAccount($id=null,$username=null,$email=null,$password=null,$role=null){
        try{
            $username=$this->connection->real_escape_string($username);
            $email=$this->connection->real_escape_string($email);
            $password=$this->connection->real_escape_string($password);
            $role=$this->connection->real_escape_string($role);
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            // Kiểm tra mật khẩu hiện tại
            $result =$this->getAccountbyId($id);
            if($result){
                $query= "UPDATE  register SET username='$username', email='$email', password='$hash_password', role='$role' WHERE id='$id'  ";
            }else{
                return false;
            }
            return mysqli_query($this->connection, $query);


        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    //delete user account function
    public function deleteAccount($id=null){
        try{
        $query_run="DELETE FROM register WHERE id='$id'";
        return mysqli_query($this->connection,$query_run);
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    //LOGIN
    //login function: check email query
    public function login($email=null,$password=null){
        try{
            $email=$this->connection->real_escape_string($email);
            $password=$this->connection->real_escape_string($password);
            $query="SELECT * FROM register WHERE email='$email'";
            $query_run= mysqli_query($this->connection,$query);
            if($query_run->num_rows>0){
                $row=mysqli_fetch_assoc($query_run);
                $stored_password=$row['password'];
                if(password_verify($password,$stored_password)){
                    return $row;
                } else{
                    return false;
                }
            }

        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }


}
?>