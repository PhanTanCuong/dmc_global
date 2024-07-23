<?php 
    class Account extends Admin{
      
        function displayAccount(){
            //Model
            $user=$this->model("AccountModel");
            
            //View
            $this->view("admin/home",[
                "user" => $user->getAccount(),
                "page"=>"displayAccount"
            ]);
        }
  
        function editAccount(){
            // $user =$this->model("AccountModel");
            // if(isset($_POST['id'])){
            //  $id=$_POST['id'];
             $this-> view("admin/home",[
                // "user" => $user->getAccountbyId($id),
                "page"=>"editAccount"
             ]);
            // }
         
           
        }

    }
?>