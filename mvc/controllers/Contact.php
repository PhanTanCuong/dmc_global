<?php
namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
class Contact extends Controller
{
    function display()
    {
        try {   

            $contact = $this->model('ProductModel');
            
            $this->view("index",[
                "about_us"=>$this->model('CategoryModel')->getCategory(32),
                "infor_mail"=>(new \Mvc\Services\SidebarService())->getSidebarData(),
                "connect"=>$contact->getProductByProductCategory(1),
                "contact"=>$contact->getProductByProductCategory(1),
                "page" => "contact"
            ]);
        } catch (Exception $e) {
            echo $e->getMessage() . '\n';
        }
    }
}
?>