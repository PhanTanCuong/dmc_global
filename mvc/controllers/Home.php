<?php 
    class Home extends Controller{
        function display(){
           $this->view("home",[]);
        }

        // function test1(){
        //     $user = $this->model("AccountModel");
        //    $this->view("home",[ //Gọi hàm view gồm tên view và mảng data 
        //     "test"=> "Test Data",
        //     "color"=> "red",
        //     "user"=> $user->getAccount() //Lấy dữ liệu từ model,
        //    ]);
        // }
    }
?>