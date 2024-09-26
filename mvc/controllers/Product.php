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

        $product_category_id = $category->getCategoryIdBySlug($slug);
        $news_category_id = $category->getCategoryIdBySlug($slug."-news");


        //View
        $this->view("home", [
            "banner" => $banner->getInforBanner($product_category_id),
            "product" => $product->getProductByProductCategory($product_category_id),
            "news" => $news->getNewsByProductCategory($news_category_id),
            "about2Infor" => $item->getLayoutbyId(3, $product_category_id),
            "about3Infor" => $item->getLayoutbyId(4, $product_category_id),
            "product1" => $item->getLayoutbyId(5, $product_category_id),
            "stats" => $item->getLayoutbyId(6, $product_category_id),
            "bg_stat" => $item->getBackgroundbyId(7),
            "page" => "displayProduct"
        ]);
    }

    function displayProductDetail(){
        try{
            $url =$_SERVER['REQUEST_URI'];
            $url_component=explode("/",$url);

            $slug =end($url_component);

            $product= $this->model('MenuModel');

            $product_data=$product->directPage($slug);
            

            $this->view('home',[
                'product_data'=>$product_data,
                'product'=>$this->model('ProductModel')->getRelatedProducts(),
                'page'=>'product',
            ]);


        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}



