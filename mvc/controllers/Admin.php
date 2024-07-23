<?php 
    class Admin extends Controller{
        function display(){
            //Model
            $total=$this->model("AccountModel");
            //View
           $this->view("admin/home",[
            "totalUser"=>$total->totalUser(),
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