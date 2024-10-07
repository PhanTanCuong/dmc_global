<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
use Mvc\Services\CategoryService as CategoryService;
class News extends Controller
{
    function display()
    {
        try {

            $post = $this->model('MenuModel');
            $category = $this->model('CategoryModel');

            $post_data = $post->directPage(SlugHelper::getSlugFromURL());
            foreach ($post_data as $row) {
                $selectedCategory=$category->getCategoryById($row['type_id']);
                $news = mysqli_fetch_assoc($selectedCategory);
                $news_category = $category->getCategoryById($row['category_id']);
            }

            $this->view('home', [
                'post' => $post_data,
                'category_info'=>$selectedCategory,
                'breadcrumb_data' => $news['name'],
                'category' => $news_category,
                'page' => 'post',
            ]);


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    function displayAbout()
    {
        try {
            $menu = $this->model('MenuModel');

            $post = $menu->directPage(SlugHelper::getSlugFromURL());

            $this->view('home', [
                'about' => $post,
                'page' => 'about',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    function displayNewsByCategory(){
        try{
            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $categoryService = new CategoryService($menuModel, $categoryModel);
            
            $news_category_json= $categoryService->getDataByCategory(SlugHelper::getSlugFromURL());
            $news_category_data=json_decode($news_category_json,true);

            $this->view('home',[
                'news_data'=> $news_category_data,
                'page'=> 'list_of_news_category'
            ]);


                    
        }catch(Exception $exception){
            echo $exception->getMessage();
        }
    }

}
?>