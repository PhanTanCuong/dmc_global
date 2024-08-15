<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Icons extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('IconsModel');
        $data = null;
        // Check if a radio button is selected
        $selected_id = isset($_POST['radio_option']) ? $_POST['radio_option'] : null;

        if ($selected_id !== null) {
            // Fetch data by the selected ID
            $data = $item->getInforIcons($selected_id);
        } else {
            // Default behavior if no radio button is selected
            $data = $item->getInforIcons(7);
        }
        $this->view('admin/home', [
            'item' => $data,
            'page' => 'customizeIcons'
        ]);
    }

    function addIcons()
    {

        try {
            if (isset($_POST["addIconsBtn"])) {
                $image = $_FILES["icons_image"]['name'];

                $item = $this->model('IconsModel');
                $success = $item->addIconsImages($image);
                if ($success) {
                    move_uploaded_file($_FILES["icons_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["icons_image"]["name"]) . '';
                    $_SESSION['success'] = 'Icons image added successfully';
                    header('Location:Icons');
                } else {
                    $_SESSION['status'] = 'Icons image NOT added successfully';
                    header('Location:Icons');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Icons');
        }
    }


    function getIconsbyID()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $id = $_POST['icons_id'];
            $result_array = [];
            $item = $this->model('IconsModel');
            $result = $item->getIconsById($id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }

    //Customize footer icons information
    function customizeIcons()
    {
        try {

            if (isset($_POST["icons_updatebtn"])) {

                $item = $this->model('IconsModel');
                $id = $_POST['edit_id'];
                $data = $item->getCurrentIconsImages($id);

                $currentImages = mysqli_fetch_array($data);

                //Check image is null
                if (!empty($_FILES["icons_image"]['name'])) {
                    $image = $_FILES["icons_image"]['name'];
                } else {
                    $image = $currentImages['image'];
                }

                $success = $item->customizeInforIcons($id, $image);
                if ($success) {
                    move_uploaded_file($_FILES["icons_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["icons_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Icons');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Icons');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Icons');
        }
    }

    function deleteIcons()
    {
        try {
            if (isset($_POST['delete_icons_btn'])) {
                $id = $_POST['delete_icons_id'];
                $item = $this->model('IconsModel');
                $success = $item->deleteIcons($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Icons');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Icons');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Icons');
        }
    }
}
