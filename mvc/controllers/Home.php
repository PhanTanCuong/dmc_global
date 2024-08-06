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

        //View
        $this->view("home", [
            "banner"=>$banner->getInforBanner(),
            "product" => $product->getProduct(),
            "news" => $news->getNews()
        ]);
    }
}
