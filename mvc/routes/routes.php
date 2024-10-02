<?php
use Core\Route;

// Trang chủ
Route::get('/', 'Home@display');

// Sản phẩm và danh mục
Route::post('/Product/fetchProductCategory', 'Product@fetchProductCategory');
Route::get('product-categories/([a-zA-Z0-9_-]+)', 'Product@display');
Route::get('product/([a-zA-Z0-9_-]+)', 'Product@displayProductDetail');
Route::get('list-product-by-category/([a-zA-Z0-9_-]+)', 'Product@displayListOfProductByCategory');
Route::get('about-us/([a-zA-Z0-9_-]+)', 'AboutUs@display');
Route::get('news/([a-zA-Z0-9_-]+)', 'News@display');
Route::get('business-services', 'Service@display');

// Đăng nhập/Đăng ký
Route::get('Signin', 'Signin@display');
Route::post('login', 'Signin@login');
Route::post('logout', 'Signin@logout');
Route::get('Register', 'Register@display');
Route::post('Register/signup', 'Register@signup');

// Admin dashboard
Route::get('Admin/dashboard', 'Home@display');

// Admin quản lý tài khoản
Route::get('Admin/Account', 'Account@display');
Route::post('Admin/addAccount', 'Account@postAccount');
Route::post('Admin/deleteAccount', 'Account@deleteAccount');
Route::post('Admin/Account/getAccountById/(\d+)', 'Account@getAccountById');
Route::post('Admin/editAccount', 'Account@editAccount');

// Admin quản lý sản phẩm
Route::get('Admin/Product', 'Product@display');
Route::post('Admin/Product/Add', 'Product@displayAddProduct');
Route::post('Admin/Product/Update', 'Product@Update');
Route::post('Admin/Product/addProduct', 'Product@addProduct');
Route::post('Admin/deleteProduct', 'Product@deleteProduct');
Route::post('Admin/Product/getProductById/(\d+)', 'Product@getProductById');
Route::post('Admin/Product/editProduct', 'Product@editProduct');

// Admin quản lý bài viết (News/Media)
Route::get('Admin/News', 'Media@display');
Route::get('Admin/News/Add', 'Media@displayAddNews');
Route::post('Admin/News/Update', 'Media@Update');
Route::post('Admin/News/addNews', 'Media@addNews');
Route::post('Admin/deleteNews', 'Media@deleteNews');
Route::post('Admin/News/getNewsById/(\d+)', 'Media@getNewsById');
Route::post('Admin/News/editNews', 'Media@editNews');

// Admin quản lý slide
Route::get('Admin/Slider', 'Slider@display');
Route::post('Admin/addBanner', 'Slider@addBanner');
Route::post('Admin/Slider/getBannerById/(\d+)', 'Slider@getBannerById');
Route::post('Admin/customizeBanner', 'Slider@customizeBanner');
Route::post('Admin/deleteBanner', 'Slider@deleteBanner');

// Admin quản lý navbar
Route::get('Admin/NavBar', 'NavBar@display');
Route::post('Admin/addNavBar', 'NavBar@addNavBar');
Route::post('Admin/NavBar/getNavBarById/(\d+)', 'NavBar@getNavBarById');
Route::post('Admin/customizeNavBar', 'NavBar@customizeNavBar');
Route::post('Admin/deleteNavBar', 'NavBar@deleteNavBar');
Route::post('Admin/sortNavbarItem', 'NavBar@sortNavbarItem');

// Admin quản lý danh mục
Route::get('Admin/Category', 'Category@display');
Route::post('Admin/addCategory', 'Category@addCategory');
Route::post('Admin/Category/getCategoryById/(\d+)', 'Category@getCategoryById');
Route::post('Admin/customizeCategory', 'Category@customizeCategory');
Route::post('Admin/deleteCategory', 'Category@deleteCategory');

//Setting
Route::get('Admin/Customize', 'Customize@display');
Route::post('Admin/customizeTab', 'Customize@customizeTab');
Route::post('Admin/customizeLogo', 'Customize@customizeLogo');
Route::post('Admin/customizeFooterLogo', 'Customize@customizeFooterLogo');

//Data
Route::get('Admin/Data', 'Data@display');
Route::post('Admin/addData','Data@addData');
Route::post('Admin/Data/getDataById/(\d+)', 'Data@getDataById');
Route::post('Admin/customizeData','Data@customizeData');
Route::post('Admin/deleteData','Data@deleteData');
?>