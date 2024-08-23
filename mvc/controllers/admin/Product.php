<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Product extends Controller
{

    public function __construct()
    {
        Middleware::checkAdmin();
    }
  

    //Load list of products layout
    function display()
    {
        //Model
        $product = $this->model("ProductModel");

        //View
        $this->view("admin/home", [
            "product" => $product->getProduct(),
            "page" => "displayProduct"
        ]);
    }

    //display detail infor user account
    function getProductById()
    {
        if(isset($_POST['checking_edit_btn'])) {
            $product_id=$_POST['product_id'];
            $result_array=[];
            $product= $this->model('ProductModel');
            $result = $product->getProductById($product_id);
            if(mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);

                }

            }
        }
    }


    //Add new product function
    function addProduct($title, $description, $link, $image)
    {
        //Model
        try {
            if (isset($_POST['addProductBtn'])) {
                $title = strip_tags($_POST['product_title']);
                $description = strip_tags($_POST['product_description']);
                $link = strip_tags($_POST['product_link']);
                $image = $_FILES["product_image"]['name'];

                $product = $this->model('ProductModel');
                $result = $product->addProduct($title, $description, $link, $image);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./public/images/" . $_FILES["product_image"]["name"]) . '';
                    $_SESSION['success'] = "Product is added successfully";
                    header('Location:Product');
                } else {
                    $_SESSION['status'] = "Product is NOT added";
                    header('Location:Product');
                }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:Product');
        }
    }


    //Edit product function

    function editProduct()
    {
        try {

            if (isset($_POST["product_updatebtn"])) {
                $title = strip_tags($_POST['product_title']);
                $description = strip_tags($_POST['product_description']);
                $link = strip_tags($_POST['product_link']);

                $id = $_POST['edit_id'];
                $product = $this->model('ProductModel');

                $data = $product->getCurrentProductImages($id);
                $stored_image = mysqli_fetch_assoc($data);
                if (!empty($_FILES["product_image"]['name'])) {
                    $image = $_FILES["product_image"]['name'];
                } else {
                    $image = $stored_image['image'];
                }
                $success = $product->editProduct($id, $title, $description, $link, $image);
                if ($success) {
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./public/images/" . $_FILES["product_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: Product');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: Product');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Product');
        }
    }

    //delete invidual product function
    function deleteProduct()
    {
        try {
            if (isset($_POST["delete_product_btn"])) {
                $id = $_POST['delete_product_id'];
                $product = $this->model('ProductModel');
                $result = $product->deleteProduct($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Product');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Product');
                }
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
                $product = $this->model('ProductModel');
                $product->toggleCheckboxDelete($id, $visible);
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
                $product = $this->model('ProductModel');
                $result = $product->multipleDeleteProduct();
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

    //Product Category
    function displayProductCategory(){
        $item=$this->model('ProductModel');

        $this->view('admin/home',[
            'page'=>'displayProductCategory',
            'item'=>$item->getInforProductCategory()
        ]);
    }

    function addProductCategory()
    {
        try {
            if (isset($_POST['addProductCategoryBtn'])) {
                $name = strip_tags($_POST['product_category_name']);

                $item=$this->model('ProductModel');
                $success = $item->addProductCategoryInfor($name);
                if( $success ) {
                    $_SESSION['success'] ='Your data is added';
                    header('Location:ProductCategory'); 
                }else{
                    $_SESSION['status'] ='Your data is NOT added';
                    header('Location:ProductCategory');
                }
                
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ProductCategory');
        }
    }
    function getProductCategoryById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['product_category_id'];
            $result_array = [];
            $item = $this->model('ProductModel');
            $result = $item->getProductCategoryById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }
    function customizeProductCategory()
    {
        try {

            if (isset($_POST["product_category_updatebtn"])) {
                $name = $_POST['product_category_name'];
                $id = $_POST['edit_id'];

                $item = $this->model('ProductModel');
                $success = $item->customizeInforProductCategory($id, $name);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:ProductCategory');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:ProductCategory');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ProductCategory');
        }
    }

    function deleteProductCategory()
    {
        try {
            if (isset($_POST['delete_product_category_btn'])) {
                $id = $_POST['delete_product_category_id'];
                $item = $this->model('ProductModel');
                $success = $item->deleteProductCategory($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:ProductCategory');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:ProductCategory');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ProductCategory');
        }
    }

}
