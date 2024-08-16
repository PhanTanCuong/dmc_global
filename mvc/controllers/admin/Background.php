<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Background extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('BackgroundModel');

        $this->view('admin/home', [
            'item' => $item->getInforBackground(),
            'page' => 'customizeBackground'
        ]);
    }

    function addBackground()
    {

        try {
            if (isset($_POST["addBackgroundBtn"])) {
                $image = $_FILES["background_image"]['name'];

                $item = $this->model('BackgroundModel');
                $success = $item->addBackgroundImages($image);
                if ($success) {
                    move_uploaded_file($_FILES["background_image"]["tmp_name"], "./public/images/" . $_FILES["background_image"]["name"]) . '';
                    $_SESSION['success'] = 'Background image added successfully';
                    header('Location:Background');
                } else {
                    $_SESSION['status'] = 'Background image NOT added successfully';
                    header('Location:Background');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Background');
        }
    }


    function getBackgroundbyID()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $id = $_POST['background_id'];
            $result_array = [];
            $item = $this->model('BackgroundModel');
            $result = $item->getBackgroundById($id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }

    //Customize backgrounds information
    function customizeBackground()
    {
        try {

            if (isset($_POST["background_updatebtn"])) {

                $item = $this->model('BackgroundModel');
                $id = $_POST['edit_id'];
                $data = $item->getCurrentBackgroundImages($id);

                $currentImages = mysqli_fetch_array($data);

                //Check image is null
                if (!empty($_FILES["background_image"]['name'])) {
                    $image = $_FILES["background_image"]['name'];
                } else {
                    $image = $currentImages['image'];
                }

                $success = $item->customizeInforBackground($id, $image);
                if ($success) {
                    move_uploaded_file($_FILES["background_image"]["tmp_name"], "./public/images/" . $_FILES["background_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Background');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Background');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Background');
        }
    }

    function deleteBackground()
    {
        try {
            if (isset($_POST['delete_background_btn'])) {
                $id = $_POST['delete_background_id'];
                $item = $this->model('BackgroundModel');
                $success = $item->deleteBackground($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Background');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Background');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Background');
        }
    }
}
