<?php
use Core\Route;
Route::add('/','Home@display');

Route::add('Signin','Signin@display');
Route::add('Signout','Signin@logout');
Route::add('Register','Register@display');
Route::add('Register/signup','Register@signup');
Route::add('Signin/login','Signin@login');


//User routes
Route::add('Product/(\d+)','Product@display');

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
// Route::add('Admin/multipleDeleteProduct','Product@multipleDeleteProduct');
// Route::add('Admin/toggleCheckboxDelete','Product@toggleCheckboxDelete');

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
Route::add('Admin/addBanner','Slider@addBanner');
Route::add('Admin/Slider/getBannerById/(\d+)', 'Slider@getBannerById');
Route::add('Admin/customizeBanner','Slider@customizeBanner');
Route::add('Admin/deleteBanner','Slider@deleteBanner');

Route::add('Admin/Customize','Customize@display');
Route::add('Admin/customizeTab','Customize@customizeTab');
Route::add('Admin/customizeLogo','Customize@customizeLogo');
Route::add('Admin/customizeFooterLogo','Customize@customizeFooterLogo');
Route::add('Admin/customizeFooterBackground','Customize@customizeFooterBackground');

Route::add('Admin/addData','Data@addData');
Route::add('Admin/Customize/getDataById/(\d+)','Customize@getDataById');
Route::add('Admin/editFooterData','Customize@editFooterData');

//Icons
Route::add('Admin/Customize','Icons@display');
Route::add('Admin/addIcons','Icons@addIcons');
Route::add('Admin/Icons/getIconsById/(\d+)', 'Icons@getIconsById');
Route::add('Admin/customizeIcons','Icons@customizeIcons');
Route::add('Admin/deleteIcons','Icons@deleteIcons');

//Data
Route::add('Admin/Data', 'Data@display');
Route::add('Admin/addData','Data@addData');
Route::add('Admin/Data/getDataById/(\d+)', 'Data@getDataById');
Route::add('Admin/customizeData','Data@customizeData');
Route::add('Admin/deleteData','Data@deleteData');

// Navbar
Route::add('Admin/NavBar','NavBar@display');
Route::add('Admin/addNavBar','NavBar@addNavBar');
Route::add('Admin/NavBar/getNavBarById/(\d+)', 'NavBar@getNavBarById');
Route::add('Admin/customizeNavBar','NavBar@customizeNavBar');
Route::add('Admin/deleteNavBar','NavBar@deleteNavBar');
Route::add('Admin/sortNavbarItem','NavBar@sortNavbarItem');

// ChildNavBar
Route::add('Admin/ChildNavBar','NavBar@displayChildNavBar');
Route::add('Admin/addChildNavBar','NavBar@addChildNavInfor');
Route::add('Admin/ChildNavBar/getChildNavBarById/(\d+)', 'NavBar@getChildNavBarById');
Route::add('Admin/customizeChildNavBar','NavBar@customizeChildNavBar');
Route::add('Admin/deleteChildNavBar','NavBar@deleteChildNavBar');

//Category
Route::add('Admin/Category','Category@display');
Route::add('Admin/addCategory','Category@addCategory');
Route::add('Admin/Category/getCategoryById/(\d+)', 'Category@getCategoryById');
Route::add('Admin/customizeCategory','Category@customizeCategory');
Route::add('Admin/deleteCategory','Category@deleteCategory');

?>