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
        //Model
        $item = $this->model("DataModel");

        //View
        $this->view("admin/home", [
            "item" => $item->getData(),
            "page" => "customizeData"
        ]);
    }
    //add new user account
    function addData()
    {
        try {
            if (isset($_POST["addDataBtn"])) {
                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);

                $item = $this->model('DataModel');
                $success = $item->addData($title, $description);
                if ($success) {
                    echo "Saved";
                    $_SESSION['success'] = 'Your data is added';
                    header('Location: Data');
                } else {
                    echo "Not save";
                    $_SESSION['status'] = 'Your data is NOT added';
                    header('Location: Data');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
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
                $success = $item->editData($id, $title, $description);
                if ($success) {
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
