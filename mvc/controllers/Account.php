<?php 
    class Account extends Controller{
        function display(){
            //Model
            $user=$this->model("AccountModel");
            
            //View
            $this->view("admin/displayAccount",[
                "user" => $user->getAccount()
            ]);
        }

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