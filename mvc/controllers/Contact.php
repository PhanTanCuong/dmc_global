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