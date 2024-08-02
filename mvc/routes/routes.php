<?php
use Core\Route;
Route::add('/','Home@display');
Route::add('Signin','Signin@display');
Route::add('Register','Register@display');
Route::add('Register/signup','Register@signup');
Route::add('Signin/login','Signin@login');


// Admi routes
Route::add('Admin/dashboard','Home@display');

?>