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
    function display()
    {
        // Model
        $item = $this->model("DataModel");
        $product_category=$this->model("ProductModel");
        $data = null;
        // Check if a radio button is selected
        $selected_id = isset($_POST['radio_option']) ? $_POST['radio_option'] : null;

        // Model
        $item = $this->model("DataModel");
        $data = null;

        if ($selected_id !== null) {
            // Fetch data by the selected ID
            $data = $item->getData($selected_id);
        } else {
            // Default behavior if no radio button is selected
            $data = $item->getData(3);
        }

        // View
        $this->view("admin/home", [
            "item" => $data,
            "product_categories" => $product_category->getInforProductCategory(),
            "page" => "customizeData"
        ]);
    }


    function addData(){
        try{
            if (isset($_POST['addDataBtn'])) {
                $title = strip_tags($_POST['data_title']);
                $description = strip_tags($_POST['data_description']);
                $image = $_FILES["data_image"]['name'];
                $selected_block_id= isset($_POST['radio_option']) ? $_POST['radio_option'] : null;
                $selected_page_id=1;
                $product = $this->model('DataModel');
                $result = $product->addData($title, $description,$image,1,$selected_page_id);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_SESSION['success'] = "Data is added successfully";
                    header('Location:Data');
                } else {
                    $_SESSION['status'] = "Data is NOT added";
                    header('Location:Data');
                }
            }

        }catch (Exception $e) {
            $_SESSION['status']=$e->getMessage();
            header('Location: Data');
        }
    }

    //getDataById()
    function getDataById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['data_id'];
            $result_array = [];
            $item = $this->model('DataModel');
            $result = $item->getDataById($item_id);
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
                $title = strip_tags($_POST['edit_title']);
                $description = strip_tags($_POST['edit_description']);
                $id = $_POST['edit_id'];
                $item = $this->model('DataModel');
                $result = $item->getDataById($id);
                $data = mysqli_fetch_assoc($result);

                $currentImage = $data['image'];

                if (!empty($_FILES["data_image"]['name'])) {
                    $image = $_FILES["data_image"]['name'];
                } else {
                    $image = $currentImage;
                }

                $success = $item->editData($id, $title, $description, $image);
                if ($success) {
                    move_uploaded_file($_FILES["data_image"]["tmp_name"], "./public/images/" . $_FILES["data_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: Data');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: Data');
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
                $result = $item->deleteData($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location: Data');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location: Data');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location: Data');
        }
    }
}
