<?php

namespace Mvc\Controllers;

use Core\Controller;
use Mvc\Utils\SlugHelper;
use Mvc\Services\CategoryService;
use MenuModel;
use CategoryModel;

class Product extends Controller
{

    function display()
    {

        //Model
        $product = $this->model("ProductModel");
        $news = $this->model("MediaModel");
        $banner = $this->model("SliderModel");
        $item = $this->model("SettingModel");
        $category = $this->model("CategoryModel");

        $product_category_id = $category->getCategoryIdBySlug(SlugHelper::getSlugFromURL());
        $news_category_id = $category->getCategoryIdBySlug(SlugHelper::getSlugFromURL() . "-news");


        //View
        $this->view("home", [
            "banner" => $banner->getInforBanner($product_category_id),
            "product" => $product->getProductByProductCategory($product_category_id),
            "news" => $news->getNewsByProductCategory($news_category_id),
            "about2Infor" => $item->getLayoutbyId(3, $product_category_id),
            "about3Infor" => $item->getLayoutbyId(4, $product_category_id),
            "product1" => $item->getLayoutbyId(5, $product_category_id),
            "stats" => $item->getLayoutbyId(6, $product_category_id),
            "bg_stat" => $item->getBackgroundbyId(7),
            "page" => "displayProduct"
        ]);
    }

    function displayProductDetail()
    {
        try {

            $product = $this->model('MenuModel');
            $product_data = $product->directPage(SlugHelper::getSlugFromURL());

            $this->view('home', [
                'product_data' => $product_data,
                'product' => $this->model('ProductModel')->getRelatedProducts(),
                'page' => 'detail_of_product',
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function displayListOfProductByCategory()
    {
        try{

            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $categoryService = new CategoryService($menuModel, $categoryModel);

            $product_category = $categoryService->getSubCategoryData(SlugHelper::getSlugFromURL());
            $selectedCategory = $menuModel->directPage(SlugHelper::getSlugFromURL());
            foreach ($selectedCategory as $row) {
                $breadcrumb_data = $categoryModel->getCategoryById($row['id']);
            }
            $this->view('home',[
                'product_category' => $product_category,
                'breadcrumb_data' => $breadcrumb_data,
                'page'=>'list_of_product_category'
            ]);

        }catch(\Exception $exception){
            echo $exception->getMessage();
        }
    }
}



