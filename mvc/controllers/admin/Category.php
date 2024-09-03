<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Category extends Controller
{
    //Product Category
    function displayCategory()
    {
        $item = $this->model('CategoryModel');

        $this->view('admin/home', [
            'page' => 'displayCategory',
            'item' => $item->getInforCategory()
        ]);
    }

    function addCategory()
    {
        try {
            if (isset($_POST['addCategoryBtn'])) {
                $name = strip_tags($_POST['product_category_name']);

                $item = $this->model('CategoryModel');
                $success = $item->addCategoryInfor($name);
                if ($success) {
                    $_SESSION['success'] = 'Your data is added';
                    header('Location:Category');
                } else {
                    $_SESSION['status'] = 'Your data is NOT added';
                    header('Location:Category');
                }

            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }
    function getCategoryById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['product_category_id'];
            $result_array = [];
            $item = $this->model('CategoryModel');
            $result = $item->getCategoryById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }
    function customizeCategory()
    {
        try {

            if (isset($_POST["product_category_updatebtn"])) {
                $name = $_POST['product_category_name'];
                $id = $_POST['edit_id'];

                $item = $this->model('CategoryModel');
                $success = $item->customizeInforCategory($id, $name);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Category');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Category');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }

    function deleteCategory()
    {
        try {
            if (isset($_POST['delete_product_category_btn'])) {
                $id = $_POST['delete_product_category_id'];
                $item = $this->model('CategoryModel');
                $success = $item->deleteCategory($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Category');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Category');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }

}
?>