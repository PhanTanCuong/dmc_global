<?php

namespace Core;
class Middleware{
    public static function checkAdmin(){
        if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!==true){
            header('Location:../');
            exit;
        }
    }
}
?>