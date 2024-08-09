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
        $banner = $this->model("SliderModel");
        $item = $this->model("CustomizeModel");
        //View
        $this->view("home", [
            "menu_items"=>$item->getMenuFooter(),
            "checkDropdownMenu" => $item->getIdDropdownMenu(),
            "getChildNavbarbyId" => function ($id) use ($item) {
                return $item->getChildNavbarbyId($id);
            },
            "banner" => $banner->getInforBanner(),
            "product" => $product->getProduct(),
            "news" => $news->getNews(),
            "head" => $item->getHeadInfor(),
            "about2Infor" => $item->getAbout2Infor(),
            "about3Infor" => $item->getAbout3Infor(),
            "product1" => $item->getProduct1Infor(),
            "stats" => $item->getStatIconInfor(),
            "icons" => $item->getFooterIconInfor(),
            "productCategory" => $item->getProductCategory(),
            "navbar_footer" => $item->getMenuFooter(),
            "bg_stat" => $item->getBackgroundbyId(7),
            "bg_footer" => $item->getBackgroundbyId(8),
            "header_icon" => $item->getIconbyId(10),
            "footer_icon" => $item->getIconbyId(22),
            "phone_icon" => $item->getIconbyId(28),
            "footer_data" => $item->getDataFooter()

        ]);
    }
}
