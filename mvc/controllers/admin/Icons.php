<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;
use Mvc\Libraries\Image;

class Icons extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('IconsModel');
        $this->view('admin/home', [
            'item' => $item->getInforIcons(7),
            'page' => 'customizeIcons'
        ]);
    }

    function addIcons()
    {

        try {
            if (isset($_POST["addIconsBtn"])) {
                $image = $_FILES["icons_image"]['name'];
                if (Image::isImageFile($_FILES["icons_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Incorrect image type.';
                    header('Location:Icons');
                    die();
                }
                $item = $this->model('IconsModel');
                $success = $item->addIconsImages($image);
                if ($success) {
                    move_uploaded_file($_FILES["icons_image"]["tmp_name"], "./public/images/" . $_FILES["icons_image"]["name"]) . '';
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


    function getIconsById()
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
                $result = $item->getIconsById($id);
                $data=mysqli_fetch_assoc($result);// fetch mysqli_result into array data

                $currentImages = $data['image'];

                //Check image is null
                if (!empty($_FILES["icons_image"]['name'])) {
                    if (Image::isImageFile($_FILES["icons_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type ';
                        header('Location:Icons');
                        die();
                    }
                    $image = $_FILES["icons_image"]['name'];
                } else {
                    $image = $currentImages;
                }

                $success = $item->customizeInforIcons($id, $image);
                if ($success) {
                    move_uploaded_file($_FILES["icons_image"]["tmp_name"], "./public/images/" . $_FILES["icons_image"]["name"]) . '';
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
