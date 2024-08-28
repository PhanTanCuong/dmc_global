<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Data extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    public function display()
    {
        // Model
        $item = $this->model("DataModel");
        $product_category = $this->model("ProductModel");
        if (isset($_GET['radio_option'])) {
            // Set new block_id and expire the old one
            setcookie("block_id", "", time() - 3600); // Expire old block_id cookie
            setcookie("block_id", $_GET['radio_option'], time() + 3600); // Set new block_id cookie
            $block_id = $_GET['radio_option'];
        } else {
            $block_id = isset($_COOKIE['block_id']) ? $_COOKIE['block_id'] : 3;
        }
        if (isset($_GET['product_category_id'])) {
            setcookie("product_category_id", "", time() - 3600); 
            setcookie("product_category_id", $_GET['product_category_id'], time() + 3600); 
            $product_category_id = $_GET['product_category_id'];
            $block_id = 3;
            setcookie("block_id", "", time() - 3600);
            setcookie("block_id", $block_id, time() + 3600);
        } else {
            $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;
        }

        // View
        $data = $item->getItem($block_id, $product_category_id);
        $this->view("admin/home", [
            "item" => $data,
            "product_categories" => $product_category->getInforProductCategory(),
            "block" => $item->getBlock(),
            "radio_button" => $block_id,
            "page" => "customizeData"
        ]);
    }

    function addData()
    {
        try {
            if (isset($_POST['addDataBtn'])) {
                $title = $_POST['data_title'];
                $description = $_POST['data_description'];
                $image = $_FILES["data_image"]['name'];
                $data = $this->model('DataModel');
                $result = $data->addData($title, $description, $image, $_COOKIE['block_id'], $_COOKIE['product_category_id']);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_GET['radio_option'] = $_COOKIE['block_id'];
                    $_SESSION['success'] = "Data is added successfully";
                    header('Location:Data');
                } else {
                    $_GET['radio_option'] = $_COOKIE['product_category_id'];
                    $_SESSION['status'] = "Data is NOT added";
                    header('Location:Data');
                }
            }

        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data');
        }
    }

    //getDataById()
    function getDataById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['data_id'];
            $result_array = [];
            $item = $this->model('DataModel');
            $result = $item->getItemById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }

    //edit  
    public function customizeData()
    {
        try {
            if (isset($_POST["editDataBtn"])) {
                $title = $_POST['edit_title'];
                $description = $_POST['edit_description'];
                $id = $_POST['edit_id'];
                $item = $this->model('DataModel');
                $result = $item->getItemById($id);
                $data = mysqli_fetch_assoc($result);

                $currentImage = $data['image'];

                if (!empty($_FILES["data_image"]['name'])) {
                    $image = $_FILES["data_image"]['name'];
                } else {
                    $image = $currentImage;
                }

                $success = $item->editItem($id, $title, $description, $image);
                if ($success) {
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Data');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Data');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location: Data');
        }
    }


    //delete user account
    public function deleteData()
    {
        try {
            if (isset($_POST["delete_btn"])) {
                $id = $_POST['delete_id'];
                $item = $this->model('DataModel');
                $result = $item->deleteItem($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Data');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Data');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data');
        }
    }
}
