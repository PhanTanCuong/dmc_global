<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;

class Post extends Controller {
    function display(){
        try{
            $url =$_SERVER['REQUEST_URI'];
            $url_component=explode("/",$url);

            $slug =end($url_component);

            $post= $this->model('MenuModel');

            $this->view('home',[
                'page'=>'post',
                'post'=>$post->directPage($slug)
            ]);


        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>