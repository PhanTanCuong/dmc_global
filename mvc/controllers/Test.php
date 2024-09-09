<?php
namespace Mvc\Controllers;

use Core\Controller;

class test extends Controller{
    function display(){
        $jsonData = $this->model("CustomizeModel");

        $this->view("test",[
             "data"=>$jsonData->test(),
             "page"=>"test"
        ]); 
    }
}

?>