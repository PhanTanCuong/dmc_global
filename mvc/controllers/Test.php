<?php
namespace Mvc\Controllers;

use Core\Controller;

class Test extends Controller{
    function display(){
        $jsonData = $this->model("SettingModel");

        $this->view("home",[
             "data"=>$jsonData->test(),
             "page"=>"test"
        ]); 
    }
}

?>