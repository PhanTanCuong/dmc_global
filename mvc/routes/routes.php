<?php
use Core\Route;
Route::add('/','Home@display');
Route::add('Signin','Signin@display');
Route::add('Register','Register@display');
Route::add('Register/signup','Register@signup');
Route::add('Signin/login','Signin@login');


// Admin routes
Route::add('Admin/dashboard','Home@display');
Route::add('Admin/Account','Account@display');
Route::add('Admin/Product','Product@display');


//Admin Account routes
Route::add('Admin/addAccount','Account@addAccount');
Route::add('Admin/deleteAccount','Account@deleteAccount');
Route::add('Admin/Account','Account@display');
Route::add('Admin/Account/getAccountById/(\d+)', 'Account@getAccountById');
Route::add('Admin/editAccount','Account@editAccount');

//Admin Product routes
Route::add('Admin/addProduct','Product@addProduct');
Route::add('Admin/deleteProduct','Product@deleteProduct');
Route::add('Admin/Product','Product@display');
Route::add('Admin/Product/getProductById/(\d+)', 'Product@getProductById');
Route::add('Admin/editProduct','Product@editProductt');

?>