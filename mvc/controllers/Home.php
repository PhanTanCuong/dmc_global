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
        // $result=$item->getAboutInfor();
        $result=$item->getAbout3Infor();
        

        //View
        $this->view("home", [
            "banner"=>$banner->getInforBanner(),
            "product" => $product->getProduct(),
            "news" => $news->getNews(),
            "about2Infor" => $item->getAbout2Infor(),
            "about3Infor" => $item->getAbout3Infor()
        ]);
    }
}
