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
        $product_category_id = end($url_components); // Lấy phần cuối cùng của URL

        //Model
        $product = $this->model("ProductModel");
        $news = $this->model("MediaModel");
        $banner = $this->model("SliderModel");
        $item = $this->model("CustomizeModel");
        // $category = $this->model("CategoryModel");


        //View
        $this->view("home", [
            "menu_items" => $item->getNavBarItem(),
            // "checkDropdownMenu" => $item->getIdDropdownMenu(),
            // "getChildNavbarbyId" => function ($id) use ($category) {
            //     return $category->getInforProductCategory();
            // },
            "banner" => $banner->getInforBanner($product_category_id),
            "product" => $product->getProduct(),
            "news" => $news->getNews(),
            "head" => $item->getHeadInfor(),
            "about2Infor" => $item->getLayoutbyId(3, $product_category_id),
            "about3Infor" => $item->getLayoutbyId(4, $product_category_id),
            "product1" => $item->getLayoutbyId(5, $product_category_id),
            "stats" => $item->getLayoutbyId(6, $product_category_id),
            "icons" => $item->getFooterIconInfor(),
            "navbar_footer" => $item->getMenuFooter(),
            "bg_stat" => $item->getBackgroundbyId(7),
            "bg_footer" => $item->getBackgroundbyId(8),
            "header_icon" => $item->getIconbyId(2),
            "footer_icon" => $item->getIconbyId(14),
            "phone_icon" => $item->getIconbyId(16),
            "footer_data" => $item->getDataFooter(),
            // Truyền dữ liệu product categories vào view
            "product_categories" => $item->fetchJsonCategory(12),
            "quick_links"=>$item->fetchJsonCategory(13),
            "page" => "displayProduct"
        ]);
    }
}



