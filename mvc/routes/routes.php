<?php
use Core\Route;
Route::add('/','Home@display');
Route::add('Signin','Signin@display');
Route::add('Signout','Signin@logout');
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
Route::add('Admin/editProduct','Product@editProduct');
// Route::add('Admin/toggleCheckboxDelete', 'Productr@toggleCheckboxDelete');

//Admin Media routes
Route::add('Admin/addNews','Media@addNews');
Route::add('Admin/deleteNews','Media@deleteNews');
Route::add('Admin/News','Media@display');
Route::add('Admin/News/getNewsById/(\d+)', 'Media@getNewsById');
Route::add('Admin/editNews','Media@editNews');

//Customize
//Slider
Route::add('Admin/Slider','Slider@display');
Route::add('Admin/customizeSlider','Slider@customBanner');

//Background
Route::add('Admin/Background','Background@display');
Route::add('Admin/addBackground','Background@addBackground');
Route::add('Admin/Background/getBackgroundById/(\d+)', 'Background@getBackgroundById');
Route::add('Admin/customizeBackground','Background@customizeBackground');
Route::add('Admin/deleteBackground','Background@deleteBackground');

//Icons
Route::add('Admin/Icons','Icons@display');
Route::add('Admin/addIcons','Icons@addIcons');
Route::add('Admin/Icons/getIconsById/(\d+)', 'Icons@getIconsById');
Route::add('Admin/customizeIcons','Icons@customizeIcons');
Route::add('Admin/deleteIcons','Icons@deleteIcons');

?>