<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Data extends Controller
{
    // protected $selected_block_id;
    // protected $product_category_id;


    public function __construct()
    {
        Middleware::checkAdmin();
    }
    public function display()
    {
        // Model
        $item = $this->model("DataModel");
        $product_category = $this->model("ProductModel");
        $selected_block_id = isset($_POST['radio_option']) ? (int) $_POST['radio_option'] : 3;

        // Initialize or retrieve the previous product_category_id from the session
        if (isset($_POST['product_category_id'])) {
            $product_category_id = (int) $_POST['product_category_id'];
            $_SESSION['product_category_id'] = $product_category_id; // Store in session
        } else {
            // Use the stored session value if POST is not set
            $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
        }
        // View
        $data = $item->getItem($selected_block_id, $product_category_id);
        $this->view("admin/home", [
            "item" => $data,
            "product_categories" => $product_category->getInforProductCategory(),
            "page" => "customizeData"
        ]);
    }


    function addData()
    {
        try {
            $selected_block_id = isset($_POST['selected_radio_option']) ? (int) $_POST['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_POST['product_category_id'])) {
                $product_category_id = (int) $_POST['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
            if (isset($_POST['addDataBtn'])) {
                $title = $_POST['data_title'];
                $description = $_POST['data_description'];
                $image = $_FILES["data_image"]['name'];
                $data = $this->model('DataModel');
                $result = $data->addData($title, $description, $image, $selected_block_id, $product_category_id);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_POST['radio_option'] = $selected_block_id;
                    $_SESSION['success'] = "Data is added successfully";
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                } else {
                    $_POST['radio_option'] = $selected_block_id;
                    $_SESSION['status'] = "Data is NOT added";
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                }
            }

        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
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
            $selected_block_id = isset($_POST['selected_radio_option']) ? (int) $_POST['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_POST['product_category_id'])) {
                $product_category_id = (int) $_POST['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
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
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                }
            }
        } catch (Exception $e) {
            header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
            header('Location: Data');
        }
    }


    //delete user account
    public function deleteData()
    {
        try {
            $selected_block_id = isset($_POST['selected_radio_option']) ? (int) $_POST['selected_radio_option'] : 3;
            // Initialize or retrieve the previous product_category_id from the session
            if (isset($_POST['product_category_id'])) {
                $product_category_id = (int) $_POST['product_category_id'];
                $_SESSION['product_category_id'] = $product_category_id; // Store in session
            } else {
                // Use the stored session value if POST is not set
                $product_category_id = isset($_SESSION['product_category_id']) ? $_SESSION['product_category_id'] : 1;
            }
            if (isset($_POST["delete_btn"])) {
                $id = $_POST['delete_id'];
                $item = $this->model('DataModel');
                $result = $item->deleteItem($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Data/' . $product_category_id . '/' . $selected_block_id);
        }
    }
}
