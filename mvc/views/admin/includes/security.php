<?php
session_start();
include ('../Database/dbconfig.php');
//Kiểm tra kết nối với dtb phpMyAdmin
// if(! $connection){

//     die("Connection fail: ".mysqli_connect_error());
// }else{
//     echo"Connected successfully";
//     mysqli_close($connection);
// }      


if ($dbconfig) {

} else {
   header('Location:../Database/dbconfig.php');

}

if (!$_SESSION['username']) {
   header('Location:../View/login.php');
}
?>