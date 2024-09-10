<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class NavBar extends Controller
{
    function __construct()
    {
        Middleware::checkAdmin();
    }

    function display()
    {
        $item = $this->model('NavBarModel');
        $category= $this->model('CategoryModel');

        // Load view
        $this->view('admin/home', [
            'page' => 'customizeNavbar',
            'item' => $item->getInforNavBar(),
            'category'=>$category->getInforCategory()
        ]);
    }

    function addNavBar()
    {
        try {
            if (isset($_POST['addNavbarItemBtn'])) {
                $name = strip_tags($_POST['navbar_name']);
                $status=$_POST['navbar_status'];
                $slug=$_POST['navbar_link'];
                $item = $this->model('NavBarModel');

                $success = $item->addNavBarInfor($name,$slug,$status);

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
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['navbar_id'];
            $result_array = [];
            $item = $this->model('NavBarModel');
            $result = $item->getNavBarById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }
    function customizeNavBar()
    {
        try {

            if (isset($_POST["editNavbarItemBtn"])) {
                $id = $_POST['edit_navbar_id'];
                $name = $_POST['edit_navbar_name'];
                $status=$_POST['edit_navbar_status'];
                $slug=$_POST['edit_navbar_link'];
                $item = $this->model('NavBarModel');
                $success = $item->customizeInforNavBar($id, $name,$status,$slug);
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


    //Child Navbar
    function displayChildNavBar()
    {
        $item = $this->model('NavBarModel');
        

        $this->view('admin/home', [
            'page' => 'customizeChildNavbar',
            'item' => $item->getInforChildNavBar(),
            'navbar_items' => $item->getInforNavBar()
        ]);
    }

    function addChildNavInfor()
    {
        try {
            if (isset($_POST['addChildNavInforBtn'])) {
                $name = strip_tags($_POST['child_nav_name']);
                $parent=strip_tags($_POST['parent_nav']);

                $item = $this->model('NavBarModel');
                $success = $item->addChildNavBar($parent,$name);
                if ($success) {
                    $_SESSION['success'] = 'Your data is added';
                    header('Location:ChildNavBar');
                } else {
                    $_SESSION['status'] = 'Your data is NOT added';
                    header('Location:ChildNavBar');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ChildNavBar');
        }
    }

    function getChildNavBarById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['child_nav_id'];
            $result_array = [];
            $item = $this->model('NavBarModel');
            $result = $item->getChildNavBarById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }

    function deleteChildNavBar()
    {
        try {
            if (isset($_POST['delete_child_nav_btn'])) {
                $id = $_POST['delete_child_nav_id'];
                $item = $this->model('NavbarModel');
                $success = $item->deleteChildNavBar($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:ChildNavBar');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:ChildNavBar');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:ChildNavBar');
        }
    }

    // sorting navbar Item
    function sortNavbarItem() {
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $array = explode(',', $ids);
            
            $allSuccess = true;
            
            for ($i = 1; $i <= count($array); $i++) {
                $success = $this->model('NavbarModel')->sortNavbarItem((int)$i, (int)$array[$i-1]);
                
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
