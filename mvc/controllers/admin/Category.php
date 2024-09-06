<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Category extends Controller
{
    //Product Category
    function display()
    {
        $item = $this->model('CategoryModel');
        $this->view('admin/home', [
            'page' => 'displayCategory',
            'edit_slug_parent' => $item->getInforCategory(),
            'slug_parent' => $item->getInforCategory(),
            'item' => $item->getInforCategory()
        ]);
    }

    function addCategory()
    {
        try {
            if (isset($_POST['addCategoryBtn'])) {
                $name = $_POST['category_name'];
                $slug = strip_tags($_POST['category_slug']);
                $parent_id = (int) $_POST['category_parent'];

                $item = $this->model('CategoryModel');

                $level = $item->traceParent($parent_id);

                $success = $item->addCategoryInfor($name, $slug, $parent_id, $level);
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
                $id = (int)$_POST['edit_category_id'];
                $name = strip_tags($_POST['edit_category_name']);
                $slug = strip_tags($_POST['edit_category_slug']);
                $parent_id = (int) $_POST['edit_category_parent'];
                if($id===$parent_id){
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Category');
                    die();
                }
                $item = $this->model('CategoryModel');

                $level = $item->traceParent($parent_id);

                $success = $item->customizeInforCategory($id, $name, $slug, $parent_id, $level);
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
                if ($item->hasChildren($id)) {
                    $_SESSION['status'] = 'The category can NOT be deleted because it has child categories.';
                    header('Location:Category');
                    die();
                }
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