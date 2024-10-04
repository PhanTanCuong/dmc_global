<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
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
            $post = $this->model('MenuModel');

            $post_data = $post->directPage(SlugHelper::getSlugFromURL());

            $this->view('home', [
                'about' => $post_data,
                'page' => 'about',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>