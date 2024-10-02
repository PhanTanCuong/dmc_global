<?php
use Core\Route;

// Trang chủ
Route::get('/', 'Home@display');

// Sản phẩm và danh mục
Route::post('/Product/fetchProductCategory', 'Product@fetchProductCategory');
Route::get('product-categories/([a-zA-Z0-9_-]+)', 'Product@display');
Route::get('product/([a-zA-Z0-9_-]+)', 'Product@displayProductDetail');
Route::get('list-product-by-category/([a-zA-Z0-9_-]+)', 'Product@displayListOfProductByCategory');
Route::get('about-us/([a-zA-Z0-9_-]+)', 'Post@displayAbout');

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
Route::post('Admin/postAccount', 'Account@postAccount');
Route::post('Admin/deleteAccount', 'Account@deleteAccount');
Route::get('Admin/Account/getAccountById/(\d+)', 'Account@getAccountById');
Route::put('Admin/editAccount', 'Account@editAccount');

// Admin quản lý sản phẩm
Route::get('Admin/Product', 'Product@display');
Route::post('Admin/Product/Add', 'Product@displayAddProduct');
Route::post('Admin/Product/Update', 'Product@Update');
Route::post('Admin/Product/postProduct', 'Product@postProduct');
Route::post('Admin/deleteProduct', 'Product@deleteProduct');
Route::get('Admin/Product/getProductById/(\d+)', 'Product@getProductById');
Route::put('Admin/Product/editProduct', 'Product@editProduct');

// Admin quản lý bài viết (News/Media)
Route::get('Admin/News', 'Media@display');
Route::get('Admin/News/Add', 'Media@displayAddNews');
Route::put('Admin/News/Update', 'Media@Update');
Route::post('Admin/News/postNews', 'Media@postNews');
Route::delete('Admin/deleteNews', 'Media@deleteNews');
Route::get('Admin/News/getNewsById/(\d+)', 'Media@getNewsById');
Route::put('Admin/News/editNews', 'Media@editNews');

// Admin quản lý slide
Route::get('Admin/Slider', 'Slider@display');
Route::post('Admin/postBanner', 'Slider@postBanner');
Route::get('Admin/Slider/getBannerById/(\d+)', 'Slider@getBannerById');
Route::put('Admin/customizeBanner', 'Slider@customizeBanner');
Route::delete('Admin/deleteBanner', 'Slider@deleteBanner');

// Admin quản lý navbar
Route::get('Admin/NavBar', 'NavBar@display');
Route::post('Admin/postNavBar', 'NavBar@postNavBar');
Route::get('Admin/NavBar/getNavBarById/(\d+)', 'NavBar@getNavBarById');
Route::put('Admin/customizeNavBar', 'NavBar@customizeNavBar');
Route::delete('Admin/deleteNavBar', 'NavBar@deleteNavBar');
Route::post('Admin/sortNavbarItem', 'NavBar@sortNavbarItem');

// Admin quản lý danh mục
Route::get('Admin/Category', 'Category@display');
Route::post('Admin/postCategory', 'Category@postCategory');
Route::get('Admin/Category/getCategoryById/(\d+)', 'Category@getCategoryById');
Route::put('Admin/customizeCategory', 'Category@customizeCategory');
Route::delete('Admin/deleteCategory', 'Category@deleteCategory');

?>