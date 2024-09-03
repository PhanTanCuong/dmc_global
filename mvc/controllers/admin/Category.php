<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Category extends Controller
{
    //Product Category
    function displayProductCategory()
    {
        $item = $this->model('ProductModel');

        $this->view('admin/home', [
            'page' => 'displayProductCategory',
            'item' => $item->getInforProductCategory()
        ]);
    }

    function addProductCategory()
    {
        try {
            if (isset($_POST['addProductCategoryBtn'])) {
                $name = strip_tags($_POST['product_category_name']);

                $item = $this->model('ProductModel');
                $success = $item->addProductCategoryInfor($name);
                if ($success) {
                    $_SESSION['success'] = 'Your data is added';
                    header('Location:ProductCategory');
                } else {
                    $_SESSION['status'] = 'Your data is NOT added';
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
?>