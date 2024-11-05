<?php
namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Auth;
use Mvc\Services\ProductService;
class AddProduct extends Controller
{
    private $category;
    private $productModel, $categoryModel, $pageModel;
    private $productService;
    public function __construct()
    {
        Auth::checkAdmin();

        $this->productModel = $this->model("ProductModel");
        $this->categoryModel = $this->model("CategoryModel");
        $this->pageModel = $this->model("PageModel");
        $this->productService = new ProductService(
            $this->productModel,
            $this->categoryModel,
            $this->pageModel
        );
        $this->category = $this->categoryModel->getCategoryByType("product");
    }

    function display()
    {
        $this->view("admin/home", [
            "product_categories" => $this->category,
            "page" => "addProduct"
        ]);
    }

    function reloadTable()
    {
        try {

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function reloadDiv()
    {
        try {

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    //Add new product function
    function addProduct()
    {
        try {
            if (isset($_POST['addProductBtn'])) {
                $this->productService->addProduct();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function fetchProduct()
    {
        try {
            if($_POST["slug"]){
                header('Content-Type: application/json');
                echo $this->productService->fetchPage($_POST["slug"]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>