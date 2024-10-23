<?php

namespace Mvc\Controllers;

use Core\Controller;

class Home extends Controller
{
    function display()
    {
        $banner= $this->model("SliderModel");
        $about= $this->model("SettingModel");
        $product=$this->model("ProductModel");

        $contentModel=$this->model('ContentModel');
        $layoutModel=$this->model('LayoutModel');

        $LayoutService = new \Mvc\Services\LayoutService($contentModel,$layoutModel);
        $this->view("index", [
            "banner"=>$banner->getInforBanner(0),
            "about2Infor"=>$LayoutService->fetchLayout(3),
            "product"=>$product->getProductByProductCategory(1),
            "media"=>$product->getProductByProductCategory(1),
            "contact"=>$about->getLayoutbyId(5,1),
            "page" => "home"
        ]); 
    }
}
