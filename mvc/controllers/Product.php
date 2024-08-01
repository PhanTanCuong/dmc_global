<?php

namespace Mvc\Controllers;

use Core\Controller;
use Core\Exception;

class Product extends Controller
{

    // Product1
    function displayProduct1()
    {
        $item = $this->model('ProductModel');

        $this->view('admin/home', [
            'item' => $item->getInforProduct1(),
            'page' => 'product1'
        ]);
    }

    //Customize about2 information
    function customProduct1()
    {
        try {

            if (isset($_POST["product1_updatebtn"])) {
                $title = strip_tags($_POST['product1_title']);
                $description = strip_tags($_POST['product1_description']);

                $item = $this->model('ProductModel');
                $data = $item->getCurrentProduct1Images();

                $currentImages = mysqli_fetch_array($data);

                //Check image is null
                if (!empty($_FILES["product1_image"]['name'])) {
                    $image = $_FILES["product1_image"]['name'];
                } else {
                    $image = $currentImages['image'];
                }


                $success = $item->customizeInforProduct1($title, $description, $image);
                if ($success) {
                    move_uploaded_file($_FILES["product1_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["product1_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayProduct1');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:displayProduct1');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayProduct1');
        }
    }

    // Product2
    //Load list of products layout
    function displayProduct()
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
    public function displayDetailProduct()
    {
        if (isset($_POST["display_product_infor_btn"])) {
            //Model
            $product = $this->model("ProductModel");

            //View
            $this->view("admin/home", [
                "product" => $product->getProductbyId($_POST['edit_product_id']),
                "page" => "editProduct"
            ]);
        }
    }


    //Add new product function
    function addProduct($title = null, $description = null, $link = null, $image = null)
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
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["product_image"]["name"]) . '';
                    $_SESSION['success'] = "Product is added successfully";
                    header('Location:displayProduct');
                } else {
                    $_SESSION['status'] = "Product is NOT added";
                    header('Location:displayProduct');
                }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:displayProduct');
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

                $id = $_POST['edit_product_id'];
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
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["product_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayProduct');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: displayProduct');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayProduct');
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
                    header('Location:displayProduct');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:displayProduct');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayProduct');
        }
    }


    //delete multiple products functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id = null, $visible = null)
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
                    header('Location:displayProduct');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:displayProduct');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
