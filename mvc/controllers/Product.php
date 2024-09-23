<?php

namespace Mvc\Controllers;

use Core\Controller;

class Product extends Controller
{

    function display()
    {
        $url = $_SERVER['REQUEST_URI']; // Lấy toàn bộ URL sau domain
        $url_components = explode('/', $url); // Tách URL thành các phần dựa trên dấu '/'

        // Giả sử URL có dạng: /dmc_global/public/Product/1
        $slug = end($url_components); // Lấy phần cuối cùng của URL

        //Model
        $product = $this->model("ProductModel");
        $news = $this->model("MediaModel");
        $banner = $this->model("SliderModel");
        $item = $this->model("SettingModel");
        $category = $this->model("CategoryModel");
        // $footer=$this->model("FooterModel");

        $product_category_id = $category->getIDCategoryBySlug($slug);


        //View
        $this->view("home", [
            "menu_items" => $item->getNavBarItem(),
            "banner" => $banner->getInforBanner($product_category_id),
            "product" => $product->getProduct(),
            "news" => $news->getNews(),
            "head" => $item->getHeadInfor(),
            "about2Infor" => $item->getLayoutbyId(3, $product_category_id),
            "about3Infor" => $item->getLayoutbyId(4, $product_category_id),
            "product1" => $item->getLayoutbyId(5, $product_category_id),
            "stats" => $item->getLayoutbyId(6, $product_category_id),
            "bg_stat" => $item->getBackgroundbyId(7),
            "header_icon" => $item->getIconbyId(2),
            "page" => "displayProduct"
        ]);
    }
}



