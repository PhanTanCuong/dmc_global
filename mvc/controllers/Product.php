<?php

namespace Mvc\Controllers;

use Core\Controller;
use Mvc\Utils\SlugHelper;
use Mvc\Services\CategoryService;
use Mvc\Services\PaginationService;
class Product extends Controller
{

    function display()
    {

        //Model
        $product = $this->model("ProductModel");
        $menuModel = $this->model('MenuModel');
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
            $menuModel = $this->model('MenuModel');
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
        try {

            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $categoryService = new CategoryService($menuModel, $categoryModel);

            $product_category_json = $categoryService->getSubCategoryData(SlugHelper::getSlugFromURL());
            $product_category=json_decode($product_category_json, true);
            $selectedCategory = $menuModel->directPage(SlugHelper::getSlugFromURL());
            foreach ($selectedCategory as $row) {
                $breadcrumb_data = mysqli_fetch_assoc($categoryModel->getCategoryById($row['id']));
            }
            $this->view('home', [
                'product_category' => $product_category,
                'breadcrumb_data' => $breadcrumb_data['name'],
                'page' => 'list_of_product_category'
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    function displayListOfProduct()
    {
        try {

            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $slug = SlugHelper::getSlugFromURL();

            $paginayionService = new PaginationService($menuModel, $categoryModel);

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $product = $paginayionService->fetchPaginationRows($slug, (int) $page, 10);
            $total_page = $paginayionService->getTotalPage($slug, 10);

            $this->view('home', [
                'product' => $product,
                'current_page' => $page,
                'total_page' => $total_page,
                'next_page' => SlugHelper::Next($page, $total_page),
                'previous_page' => SlugHelper::Previous($page),
                'breadcrumb_data' => 'Product',
                'page' => 'list_of_product',
            ]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}



