<?php

namespace Mvc\Controllers;

use Core\Controller;
use Mvc\Utils\SlugHelper;
use Mvc\Services\CategoryService;
use Mvc\Services\PaginationService;
use Core\Auth;
class Product extends Controller
{

    private $product,$news,$banner,$item,$category,$page;
    private $categoryService,$paginationService;
    private $slug;
    public function __construct(){
        $this->product= $this->model("ProductModel");
        $this->news= $this->model("PostModel");
        $this->banner= $this->model("SliderModel");
        $this->item= $this->model("SettingModel");
        $this->category= $this->model("CategoryModel");
        $this->page=$this->model("PageModel");
        $this->paginationService = new PaginationService($this->page, $this->category);
        $this->categoryService = new CategoryService($this->page, $this->category);

        $this->slug = SlugHelper::getSlugFromURL();
    }
    
    function display()
    {
        $product_category_id = $this->category->getCategoryIdBySlug($this->slug);
        $news_category_id = $this->category->getCategoryIdBySlug($this->slug . "-news");
        //View
        $this->view("index", [
            "banner" => $this->banner->getInforBanner($product_category_id),
            "product" => $this->product->getProductByProductCategory($product_category_id),
            "news" => $this->news->getNewsByProductCategory($news_category_id),
            "about2Infor" => $this->item->getLayoutbyId(3, $product_category_id),
            "about3Infor" => $this->item->getLayoutbyId(4, $product_category_id),
            "product1" => $this->item->getLayoutbyId(5, $product_category_id),
            "stats" => $this->item->getLayoutbyId(6, $product_category_id),
            "bg_stat" => $this->item->getBackgroundbyId(7),
            "page" => "displayProduct"
        ]);
    }

    function displayProductDetail()
    {
        try {
            $product_data = $this->product->directPage($this->slug);
            $this->view("index", [
                'product_data' => $product_data,
                'product' => $this->product->getRelatedProducts(),
                'product_category'=>$this->categoryService->getProductCategory($this->slug),
                'page' => 'detail_of_product',
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function displayListOfProductByCategory()
    {
        try {
            $product_category_json = $this->categoryService->getSubCategoryData($this->slug);
            $product_category=json_decode($product_category_json, true);
            $selectedCategory = $this->page->directPage($this->slug);
            foreach ($selectedCategory as $row) {
                $breadcrumb_data = mysqli_fetch_assoc($this->category->getCategoryById($row['id']));
            }
            $this->view("index", [
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
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $product = $this->paginationService->fetchPaginationRows($this->slug, (int) $page, 10);
            $total_page = $this->paginationService->getTotalPage($this->slug, 10);

            $this->view("index", [
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



