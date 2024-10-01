<?php
use Core\Route;
Route::add('/','Home@display');
Route::add('/Product/fetchProductCategory', 'Product@fetchProductCategory');


Route::add('Signin','Signin@display');
Route::add('Signout','Signin@logout');
Route::add('Register','Register@display');
Route::add('Register/signup','Register@signup');
Route::add('Signin/login','Signin@login');


//User routes
Route::add('product-categories/([a-zA-Z0-9_-]+)', 'Product@display');
Route::add('product/([a-zA-Z0-9_-]+)', 'Product@displayProductDetail');
Route::add('list-product-by-category/([a-zA-Z0-9_-]+)', 'Product@displayProductDetail');
Route::add('news/([a-zA-Z0-9_-]+)', 'Post@display');
Route::add('about-us/([a-zA-Z0-9_-]+)', 'Post@displayAbout');


// Admin routes
Route::add('Admin/dashboard','Home@display');
Route::add('Admin/Account','Account@display');
Route::add('Admin/Product','Product@display');
Route::add('Admin/News','Media@display');



//Admin Account routes
Route::add('Admin/addAccount','Account@addAccount');
Route::add('Admin/deleteAccount','Account@deleteAccount');
Route::add('Admin/Account','Account@display');
Route::add('Admin/Account/getAccountById/(\d+)', 'Account@getAccountById');
Route::add('Admin/editAccount','Account@editAccount');

//Admin Product routes
Route::add('Admin/Product/Add','Product@displayAddProduct');
Route::add('Admin/Product/Update','Product@Update');
Route::add('Admin/Product/addProduct','Product@addProduct');
Route::add('Admin/deleteProduct','Product@deleteProduct');
Route::add('Admin/Product','Product@display');
Route::add('Admin/Product/getProductById/(\d+)', 'Product@getProductById');
Route::add('Admin/Product/editProduct','Product@editProduct');
// Route::add('Admin/multipleDeleteProduct','Product@multipleDeleteProduct');
// Route::add('Admin/toggleCheckboxDelete','Product@toggleCheckboxDelete');

// Route::add('Admin/toggleCheckboxDelete', 'Productr@toggleCheckboxDelete');

//Admin Media routes
Route::add('Admin/News/Add','Media@displayAddNews');
Route::add('Admin/News/Update','Media@Update');
Route::add('Admin/News/addNews','Media@addNews');
Route::add('Admin/deleteNews','Media@deleteNews');
Route::add('Admin/News/getNewsById/(\d+)', 'Media@getNewsById');
Route::add('Admin/News/editNews','Media@editNews');

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
Route::add('Admin/customizeQuickLink','Customize@customizeQuickLink');

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
Route::add('Admin/fetchChildCategories','NavBar@fetchChildCategories');
Route::add('Admin/editChildItems','Navbar@editChildItems');

//Category
Route::add('Admin/Category','Category@display');
Route::add('Admin/addCategory','Category@addCategory');
Route::add('Admin/Category/getCategoryById/(\d+)', 'Category@getCategoryById');
Route::add('Admin/customizeCategory','Category@customizeCategory');
Route::add('Admin/deleteCategory','Category@deleteCategory');



?>