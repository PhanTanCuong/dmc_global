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
            //PASSWORD_BCRYPT: độ dài=60
            //PASSWORD_DEFAULT: độ dài=255
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            $query= "INSERT INTO register (username,email,password,role) VALUES ('$username','$email','$hash_password','$role')";

            $query_run = mysqli_query($this->connection, $query);

            if($query_run){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
            
            
    }

    //edit user account function
    public function editAccount($id=null,$username=null,$email=null,$password=null,$role=null){
        try{
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            // Kiểm tra mật khẩu hiện tại
            $result =$this->getAccountbyId($id);
            if($result){
            $store_password = mysqli_fetch_assoc($result)['password'];
                if(password_verify($password, $store_password)){
                    $query= "UPDATE  register SET username='$username', email='$email', role='$role' WHERE id='$id'  ";
                }else{
                    $query= "UPDATE  register SET username='$username', email='$email', password='$hash_password', role='$role' WHERE id='$id'  ";
                }
            }else{
                return false;
            }
            $query_run = mysqli_query($this->connection, $query);

            if($query_run){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
            
            
    }


}
?>