<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Auth;

class NavBar extends Controller
{
    function __construct()
    {
        Auth::checkAdmin();
    }

    function display()
    {
        $item = $this->model('NavBarModel');
        $category = $this->model('CategoryModel');

        // Load view
        $this->view('admin/home', [
            'page' => 'customizeNavbar',
            'item' => $item->getInforNavBar(),
            'links'=> $item->getLinkList(),
            'parent_categories' => $category->getParentCategories(),
            'category' => $category->getInforCategory(),
        ]);
    }

    function addNavBar()
    {
        try {
            if (isset($_POST['addNavbarItemBtn'])) {
                $name = strip_tags($_POST['navbar_name']);
                $status = $_POST['navbar_status'];
                $slug = $_POST['navbar_link'];
                $item = $this->model('NavBarModel');

                $success = $item->addNavBarInfor($name, $slug, $status);

                if ($success) {
                    $_SESSION['success'] = 'Your data is added';
                    header('Location:NavBar');
                } else {
                    $_SESSION['status'] = 'Your data is NOT added';
                    header('Location:NavBar');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:NavBar');
        }
    }

    function getNavBarById()
    {
        try {
            if (isset($_POST['checking_edit_btn'])) {
                $item_id = $_POST['navbar_id'];
                $result_array = [];
                $item = $this->model('NavBarModel');
                $result = $item->getNavBarById($item_id);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //Kiểm tra nếu giá trị child_items column rỗng
                        if (!empty($row['child_items'])) {
                            // Lấy dữ liệu JSON từ cột 'child_item'
                            $child_items_json = $row['child_items'];

                            // Giải mã chuỗi JSON thành mảng PHP
                            $child_items = json_decode($child_items_json, true);

                            // Kiểm tra nếu dữ liệu JSON được giải mã thành công
                            if (is_array($child_items)) {
                                $row['child_items'] = $child_items; // Thêm mảng này vào kết quả trả về
                            }
                        }else{
                            $row['child_items'] = []; 
                        }


                        $result_array['navbar'] = $row;
                    }


                    // Send JSON response back to AJAX
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        } catch (\Exception $exception) {

            echo 'Error: ' . $exception->getMessage();

        }
    }
    function customizeNavBar()
    {
        try {

            if (isset($_POST["editNavbarItemBtn"])) {
                $id = $_POST['edit_navbar_id'];
                $name = $_POST['edit_navbar_name'];
                $status = $_POST['edit_navbar_status'];
                $slug = $_POST['edit_navbar_link'];
                $item = $this->model('NavBarModel');
                $success = $item->customizeInforNavBar($id, $name, $status, $slug);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:NavBar');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:NavBar');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:NavBar');
        }
    }

    function deleteNavBar()
    {
        try {
            if (isset($_POST['delete_navbar_btn'])) {
                $id = $_POST['delete_navbar_id'];
                $item = $this->model('NavbarModel');
                $success = $item->deleteNavBar($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:NavBar');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:NavBar');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:NavBar');
        }
    }


    //Child Navbar Item

    public function fetchChildCategories()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $parentCategoryId = $_POST['parentCategoryId'];
            $categoryModel = $this->model('CategoryModel');
            $childCategories = $categoryModel->getChildCategoriesByParentId($parentCategoryId);
            $dataId = $_POST['dataId'];
            $categoryModel = $this->model('NavbarModel');
            $childCategories = $categoryModel->getAvailableItems($parentCategoryId, $dataId);

            // Trả về kết quả dạng JSON
            echo json_encode($childCategories);
        }
    }

    function editChildItems()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedItems'])) {
                $selectedItems = json_decode($_POST['selectedItems'], true);
                $id = (int) $_POST['quick_link_id'];

                $data = $this->model('NavbarModel');
                $success = $data->storedSelectedChildItems($selectedItems, $id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Customize');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Customize');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Customize');
        }
    }

    // sorting navbar Item
    function sortNavbarItem()
    {
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $array = explode(',', $ids);

            $allSuccess = true;

            for ($i = 1; $i <= count($array); $i++) {
                $success = $this->model('NavbarModel')->sortNavbarItem((int) $array[$i - 1], (int) $i);

                if (!$success) {
                    $allSuccess = false;
                    break;
                }
            }

            if ($allSuccess) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update navbar items']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No IDs received']);
        }
    }

}
