<?php
namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
class Cooperation extends Controller{
    function display(){

        $menu = $this->model('MenuModel');
        $post=$menu->directPage(SlugHelper::getSlugFromURL());

        $this->view("index",[
            'post'=>$post,
            'page'=>'cooperation'
        ]);
    }
}
?>