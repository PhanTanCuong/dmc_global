<?php 
    class Account extends Admin{
  
        function loadEditUserForm(){
            $user =$this->model("AccountModel");
            if(isset($_POST['id'])){
             $id=$_POST['id'];
             $this-> view("admin/editAccount",[
                "user" => $user->getAccountbyId($id),
             ]);
            }
         
           
        }

    }
?>