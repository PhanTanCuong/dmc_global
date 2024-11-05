<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Auth;
use Mvc\Utils\Image;
use Mvc\Utils\ImageHelper;

class Data extends Controller
{
    public function __construct()
    {
        Auth::checkAdmin();
    }
    public function display()
    {
        // Model
        $item = $this->model("DataModel");
        if (!isset($_COOKIE["parent_id"])) {
            $_SESSION["status"] = "Invalid parent id cookie";
            header("Location: " . $_ENV['BASE_URL'] . "/Admin/dashboard");
            die();
        }

        $parent_id = (int) $_COOKIE["parent_id"];
        $product_category = $this->model('CategoryModel')->getCategory($parent_id);

        $data= (new \Mvc\Utils\LayoutHelper())->getBlockIdAndcategoryId();
        // View
        $this->view("admin/home", [
            "item" => $item->getItem($data["block_id"],$data["product_category_id"]),
            "product_categories" => $product_category,
            "block" => $item->getBlock(),
            "radio_button" => $data["block_id"],
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
                if (ImageHelper::isImageFile($_FILES["data_image"]) === false) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:Data');
                    die();
                }
                $result = $data->addData($title, $description, $image, $_COOKIE['block_id'], $_COOKIE['product_category_id']);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file(
                        $_FILES["data_image"]["tmp_name"],
                        "./public/images/" . $_FILES["data_image"]["name"]
                    ) . '';
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
    function customizeData()
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
                    if (ImageHelper::isImageFile($_FILES["data_image"]) === false) {
                        $_SESSION['status'] = 'Lỗi! Sai định dạng hình ảnh!!! ';
                        header('Location:Data');
                        die();
                    }
                } else {
                    $image = $currentImage;
                }

                $success = $item->editItem($id, $title, $description, $image);
                if ($success) {
                    move_uploaded_file(
                        $_FILES["data_image"]["tmp_name"],
                        "./public/images/" . $_FILES["data_image"]["name"]
                    ) . '';
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
    function deleteData()
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
