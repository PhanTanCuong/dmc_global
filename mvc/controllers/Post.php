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
            $category = $this->model('CategoryModel');

            $post_data=$post->directPage($slug);
            foreach($post_data as $row){
                $news=$category->getCategoryById($row['type_id']);
                $news_category=$category->getCategoryById($row['category_id']);
            }

            $this->view('home',[
                'post'=>$post_data,
                'news'=>$news,
                'category'=>$news_category,
                'page'=>'post',
            ]);


        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
?>