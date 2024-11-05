<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Auth;
use Mvc\Services\ProductService;
class Product extends Controller
{
    private $category;
    private $productModel, $categoryModel, $pageModel, $navbarModel;
    private $productService;
    public function __construct()
    {
        Auth::checkAdmin();

        $this->productModel = $this->model("ProductModel");
        $this->categoryModel = $this->model("CategoryModel");
        $this->pageModel = $this->model("PageModel");
        $this->navbarModel = $this->model("NavbarModel");
        $this->productService = new ProductService(
            $this->productModel,
            $this->pageModel,
            $this->navbarModel,
            $this->categoryModel,
        );
        $this->category = $this->categoryModel->getCategoryByType("product");
    }


    //Load list of products layout
    function display()
    {
        $this->view("admin/home", [
            "product" => $this->productModel->getProduct(),
            "page" => "displayProduct"
        ]);
    }

    function displayAddProduct()
    {
        $this->view("admin/home", [
            "product_categories" => $this->category,
            "page" => "addProduct"
        ]);
    }

    function Update()
    {
        if (isset($_GET['checking_edit_btn'])) {
            $product_id = (int) $_GET['product_id'];
            $product = $this->productModel->getProductbyId($product_id);
        }

        // dd($this->category);
        $this->view("admin/home", [
            "product" => $product,
            "product_categories" => $this->category,
            "page" => "editProduct"
        ]);
    }
    //Add new product function
    function addProduct()
    {
        try {
            if (isset($_POST['addProductBtn'])) {
                $this->productService->addProduct();
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:../Product');
        }
    }

    //Edit product function

    function editProduct()
    {
        try {
            if (isset($_POST["product_updatebtn"])) {
                $this->productService->updateProduct();
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:../Product');
        }
    }

    //delete invidual product function
    function deleteProduct()
    {
        try {
            if (isset($_POST["delete_product_btn"])) {
                $this->productService->deleteProduct($_POST['delete_product_id']);
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Product');
        }
    }

    //delete multiple products functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id, $visible)
    {
        try {
            if (isset($_POST['search_data'])) {
                $id = $_POST['id'];
                $visible = $_POST['visible'];
                $this->productModel->toggleCheckboxDelete($id, $visible);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteProduct()
    function multipleDeleteProduct()
    {
        try {
            if (isset($_POST['delete-multiple-data'])) {
                $result = $this->productModel->multipleDeleteProduct();
                if ($result) {
                    $_SESSION['success'] = 'Your products are deleted';
                    header('Location:Product');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:Product');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function reloadTable()
    {
        try {

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function reloaddiv()
    {
        try {

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function fetchProduct(){
        try{

            if (isset($_POST['slug'])) {
                //send JSON response back to AJAX
                header('Content-Type: application/json');
                echo $this->productService->fetchPage($_POST["slug"]);
            }
        }catch (Exception $e) {
            return json_encode(["error"=>$e->getMessage()]);
        }
    }
}
