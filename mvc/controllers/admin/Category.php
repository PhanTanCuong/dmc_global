<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Auth;
class Category extends Controller
{
    protected $categoryService, $categoryModel, $pageModel;

    function __construct()
    {
        Auth::checkAdmin();
        $this->categoryModel = $this->model("CategoryModel");
        $this->pageModel = $this->model("PageModel");
        $this->categoryService =
            new \Mvc\Services\CategoryService(
                $this->pageModel,
                $this->categoryModel,
            );
    }

    function display()
    {
        $item = $this->model('CategoryModel');

        $this->view('admin/home', [
            'page' => 'displayCategory',
            'item' => $item->getInforCategory(),
            'edit_slug_parent' => $item->getInforParentCategory(3),
            'slug_parent' => $item->getInforParentCategory(3),

        ]);
    }

    function addCategory()
    {
        try {
            if (isset($_POST['addCategoryBtn'])) {
                $this->categoryService->addCategory();
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }
    function getCategoryById()
    {
        try {
            if (isset($_POST['checking_edit_btn'])) {
                $item_id = $_POST['category_id'];
                $result = $this->categoryModel->getCategoryById($item_id);
                // dd($result);
                header('Content-Type: application/json');
                echo json_encode($result);
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }
    function customizeCategory()
    {
        try {
            if (isset($_POST["category_updatebtn"])) {
                $this->categoryService->editCategory();
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
              $this->categoryService->deleteCategory($_POST['delete_category_id']);
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Category');
        }
    }



}
?>