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

        // $block_id = isset($_GET['block_id']) ? $_GET['block_id'] : 3;
    
        // Handle product_category_id
        if (isset($_GET['product_category_id'])) {
            // Set new product_category_id and expire the old one
            setcookie("product_category_id", "", time() - 3600); // Expire old product_category_id cookie
            setcookie("product_category_id", $_GET['product_category_id'], time() + 3600); // Set new product_category_id cookie
            $product_category_id = $_GET['product_category_id'];
            $block_id=3;
        } else {
            $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;
        }



        // View
        $data = $item->getItem($block_id, $product_category_id);
        $this->view("admin/home", [
            "item" => $data,
            "product_categories" => $product_category->getInforProductCategory(),
            "block"=>$item->getBlock(),
            "radio_button"=>$block_id,
            "page" => "customizeData"
        ]);
    }





    function addData()
    {
        try {
            $block_id = isset($_GET['selected_radio_option']) ? (int) $_GET['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_GET['product_category_id'])) {
                $product_category_id = (int) $_GET['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
            if (isset($_GET['addDataBtn'])) {
                $title = $_GET['data_title'];
                $description = $_GET['data_description'];
                $image = $_FILES["data_image"]['name'];
                $data = $this->model('DataModel');
                $result = $data->addData($title, $description, $image, $block_id, $product_category_id);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_GET['radio_option'] = $block_id;
                    $_SESSION['success'] = "Data is added successfully";
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                } else {
                    $_GET['radio_option'] = $block_id;
                    $_SESSION['status'] = "Data is NOT added";
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                }
            }

        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data/' . $product_category_id . '/' . $block_id);
        }
    }

    //getDataById()
    function getDataById()
    {
        if (isset($_GET['checking_edit_btn'])) {
            $item_id = $_GET['data_id'];
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
            $block_id = isset($_GET['selected_radio_option']) ? (int) $_GET['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_GET['product_category_id'])) {
                $product_category_id = (int) $_GET['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
            if (isset($_GET["editDataBtn"])) {
                $title = $_GET['edit_title'];
                $description = $_GET['edit_description'];
                $id = $_GET['edit_id'];
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
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                }
            }
        } catch (Exception $e) {
            header('Location:Data/' . $product_category_id . '/' . $block_id);
            header('Location: Data');
        }
    }


    //delete user account
    public function deleteData()
    {
        try {
            $block_id = isset($_GET['selected_radio_option']) ? (int) $_GET['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_GET['product_category_id'])) {
                $product_category_id = (int) $_GET['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
            if (isset($_GET["delete_btn"])) {
                $id = $_GET['delete_id'];
                $item = $this->model('DataModel');
                $result = $item->deleteItem($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Data/' . $product_category_id . '/' . $block_id);
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data/' . $product_category_id . '/' . $block_id);
        }
    }
}
