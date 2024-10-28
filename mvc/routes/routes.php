<?php
use Core\Route;

// Trang chủ
Route::get('/', 'Home@display');

// Sản phẩm và danh mục
Route::post('Product/fetchProductCategory', 'Product@fetchProductCategory');
Route::get('product-categories/([a-zA-Z0-9_-]+)', 'Product@display');
Route::get('product/([a-zA-Z0-9_-]+)', 'Product@displayProductDetail');
Route::get('list-product-by-category/([a-zA-Z0-9_-]+)', 'Product@displayListOfProductByCategory');
Route::get('list-news-by-category/([a-zA-Z0-9_-]+)-news', 'News@displayNewsByCategory');
Route::get('product', 'Product@displayListOfProduct');
Route::get('news/([a-zA-Z0-9_-]+)', 'News@displayNewsDetail');
Route::get('news', 'News@display');

//pages
Route::get('business-services', 'Service@display');
Route::get('cooperation', 'Cooperation@display');
Route::get('media', 'Post@display');
Route::get('contact-us', 'Contact@display');
Route::get('404', 'NotFound@display');
Route::get('about-us/([a-zA-Z0-9_-]+)', 'AboutUs@display');
Route::get('', 'Home@display');





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
Route::get('Admin/Product/Add', 'Product@displayAddProduct');
Route::get('Admin/Product/Update', 'Product@Update');
Route::post('Admin/Product/addProduct', 'Product@addProduct');
Route::post('Admin/deleteProduct', 'Product@deleteProduct');
Route::post('Admin/Product/getProductById/(\d+)', 'Product@getProductById');
Route::post('Admin/Product/editProduct', 'Product@editProduct');

// Admin quản lý bài viết (News/Post)
Route::get('Admin/News', 'Post@display');
Route::get('Admin/News/Add', 'Post@displayAddNews');
Route::post('Admin/News/Update', 'Post@Update');
Route::post('Admin/News/addNews', 'Post@addNews');
Route::post('Admin/deleteNews', 'Post@deleteNews');
Route::post('Admin/News/getNewsById/(\d+)', 'Post@getNewsById');
Route::post('Admin/News/editNews', 'Post@editNews');


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
Route::post('Admin/editChildItems', 'NavBar@editChildItems');
Route::post('Admin/fetchChildCategories', 'NavBar@fetchChildCategories');



// Admin quản lý danh mục
Route::get('Admin/Category', 'Category@display');
Route::post('Admin/addCategory', 'Category@addCategory');
Route::post('Admin/Category/getCategoryById/(\d+)', 'Category@getCategoryById');
Route::post('Admin/customizeCategory', 'Category@customizeCategory');
Route::post('Admin/deleteCategory', 'Category@deleteCategory');

// Admin quản lý trang cooperation
Route::get('Admin/Cooperation', 'Cooperation@display');
Route::post('Admin/editCooperation', 'Cooperation@editCooperation');

//Admin quản lý thiết lập
Route::get('Admin/Customize', 'Customize@display');
Route::post('Admin/customizeTab', 'Customize@customizeTab');
Route::post('Admin/customizeLogo', 'Customize@customizeLogo');
Route::post('Admin/customizeFooterLogo', 'Customize@customizeFooterLogo');
Route::post('Admin/customizeFooterLogo', 'Customize@customizeFooterBackground');
Route::post('Admin/Customize/getDataById/(\d+)', 'Customize@getDataById');
Route::post('Admin/editFooterData', 'Customize@editFooterData');
Route::post('Admin/customizeQuickLink', 'Customize@customizeQuickLink');


//Admin quản lý icons
Route::post('Admin/deleteIcons', 'Icons@deleteIcons');
Route::post('Admin/customizeIcons', 'Icons@customizeIcons');
Route::post('Admin/addIcons', 'Icons@addIcons');
Route::post('Admin/Icons/getIconsById/(\d+)', 'Icons@getIconsById');



//Admin quản lý layout
Route::get('Admin/Data', 'Data@display');
Route::post('Admin/addData','Data@addData');
Route::post('Admin/Data/getDataById/(\d+)', 'Data@getDataById');
Route::post('Admin/customizeData','Data@customizeData');
Route::post('Admin/deleteData','Data@deleteData');


//Admin quản lý layout
Route::get('Admin/layout','Layout@display');
Route::post('Admin/addContent','Layout@addContent');
?>