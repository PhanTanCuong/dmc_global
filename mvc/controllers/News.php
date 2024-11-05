<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
use Mvc\Services\CategoryService as CategoryService;
class News extends Controller
{

    protected $pageModel,$categoryModel,$categoryService;

    public function __construct(){
        $this->pageModel = $this->model("PageModel");
        $this->$this->categoryModel = $this->model('CategoryModel');
        $this->categoryService = new CategoryService($this->pageModel, $this->$this->categoryModel);
    }

    function display()
    {
        try {

           

            $news_category_json = $this->categoryService->getSubCategoryData(SlugHelper::getSlugFromURL());
            $news_category = json_decode($news_category_json, true);
            $selectedCategory = $this->pageModel->directPage(SlugHelper::getSlugFromURL());
            foreach ($selectedCategory as $row) {
                $breadcrumb_data = mysqli_fetch_assoc($$this->categoryModel->getCategoryById($row['id']));
            }
            $this->view("index", [
                'news' => $news_category,
                'breadcrumb_data' => $breadcrumb_data['name'],
                'page' => 'list_of_news'
            ]);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    function displayAbout()
    {
        try {
            $menu = $this->model("PageModel");

            $post = $menu->directPage(SlugHelper::getSlugFromURL());

            $this->view("index", [
                'about' => $post,
                'page' => 'about',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    function displayNewsByCategory()
    {
        try {
            $news_category_json = $this->categoryService->getDataByCategory(SlugHelper::getSlugFromURL());
            $news_category_data = json_decode($news_category_json, true);

            $this->view("index", [
                'news_data' => $news_category_data,
                'page' => 'list_of_news_category'
            ]);



        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    function displayNewsDetail()
    {
        try {

            $post_data = $this->pageModel->directPage(SlugHelper::getSlugFromURL());
            foreach ($post_data as $row) {
                $selectedCategory = $this->categoryModel->getCategoryById($row['type_id']);
                $news = mysqli_fetch_assoc($selectedCategory);
                $news_category = $this->categoryModel->getCategoryById($row['category_id']);
            }

            $this->view("index", [
                'post' => $post_data,
                'category_info' => $selectedCategory,
                'breadcrumb_data' => $news['name'],
                'category' => $news_category,
                'page' => 'post',
            ]);


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
?>