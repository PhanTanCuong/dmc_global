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

        //View
        $this->view("home", [
            "product" => $product->getProduct(),
            "news" => $news->getNews()
        ]);
    }
}
