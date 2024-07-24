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

        
     


    }
?>