<?php
namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
class Media extends Controller
{
    function display()
    {
        try{
            $media = $this->model('ProductModel');
            $this->view("index",[
                "media"=>$media->getProductByProductCategory(1),
                "page"=>"media",
            ]);
        }catch(Exception $e){
            echo "Error: " . $e->getMessage().'\n';
        }
    }
}
?>