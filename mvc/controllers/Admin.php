<?php 
    class Admin extends Controller{
        function display(){
           $this->view("admin/home",[
            "page"=>"main"
 
           ]);
        }

        function displayAccount(){
            //Model
            $user=$this->model("AccountModel");
            
            //View
            $this->view("admin/home",[
                "user" => $user->getAccount(),
                "page"=>"displayAccount"
            ]);
        }
    }
?>