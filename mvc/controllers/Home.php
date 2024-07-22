<?php 
    class Home extends Controller{
        function test(){
            $user = $this->model("AccountModel");
            echo $user->getAccount();
        }

        function test1(){
            echo "test1";
        }
    }
?>