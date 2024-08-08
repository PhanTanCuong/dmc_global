<?php

namespace Mvc\Controllers;

use Core\Controller;

class Home extends Controller
{
    function display()
    {
        //Model
        $product = $this->model("ProductModel");
        $news = $this->model("MediaModel");
        $banner=$this->model("SliderModel");
        $item=$this->model("CustomizeModel");
        //View
        $this->view("home", [
            "banner"=>$banner->getInforBanner(),
            "product" => $product->getProduct(),
            "news" => $news->getNews(),
            "head"=> $item->getHeadInfor(),
            "about2Infor" => $item->getAbout2Infor(),
            "about3Infor" => $item->getAbout3Infor(),
            "product1" => $item->getProduct1Infor(),
            "stats"=> $item->getStatIconInfor(),
            "icons"=> $item->getFooterIconInfor()
        ]);
    }
}
