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
            'slug_parent'=> $item-> getSlugParent(),
            'item' => $item->getInforCategory()
        ]);
    }

    function addCategory()
    {
        try {
            if (isset($_POST['addCategoryBtn'])) {
                
                $slug = strip_tags($_POST['category_slug']);
                $parent_id=(int)$_POST['category_parent'];

                $item = $this->model('CategoryModel');
                $category_level = $item->traceParent($parent_id);
                $prefix =str_repeat('|---',$category_level);
                $name = $prefix.strip_tags($_POST['category_name']);


                $success = $item->addCategoryInfor($name,$slug,$parent_id);
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
            $item_id = $_POST['category_id'];
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

            if (isset($_POST["category_updatebtn"])) {
                $name = $_POST['category_name'];
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
            if (isset($_POST['delete_category_btn'])) {
                $id = $_POST['delete_category_id'];
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