<?php

namespace Core;
class Auth{
    public static function checkAdmin(){
        if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!==true){
            header('Location:../product/base-oil');
            exit;
        }
    }
}
?>