<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Customize extends Controller
{
    function __construct()
    {
        Middleware::checkAdmin();
    }

    function display()
    {
        $item = $this->model('CustomizeModel');
        $data = $this->model('DataModel');

        $this->view('admin/home', [
            'page' => 'customizeContent',
            'head' => $item->getHeadInfor(),
            "header_icon" => $item->getIconbyId(2),
            "footer_icon" => $item->getIconbyId(14),
            "bg_footer" => $item->getBackgroundbyId(8),
            "item" => $data->getData(7),
        ]);
    }

    function customizeTab()
    {
        try {

            if (isset($_POST["head_updatebtn"])) {
                $name = $_POST["head_title"];
                $item = $this->model('CustomizeModel');
                $data = $item->getHeadInfor();
                foreach ($data as $row) {
                    $currentImage = $row['image'];
                };
                if (!empty($_FILES["head_image"]["name"])) {
                    // If a new image is uploaded, use it
                    $image = $_FILES["head_image"]["name"];
                } else {
                    // If no new image, retain the existing one
                    $image = $currentImage;
                }

                $success = $item->customizeHeaderInfor($name, $image);
                if ($success) {
                    move_uploaded_file($_FILES["head_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["head_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Customize');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Customize');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Customize');
        }
    }

    function customizeLogo()
    {
        try {

            if (isset($_POST["head_logo_updatebtn"])) {
                $item = $this->model('CustomizeModel');
                $data = $item->getIconbyId(2);
                foreach ($data as $row) {
                    $currentImage = $row['image'];
                }
                if (!empty($_FILES["header_icon"]["name"])) {
                    // If a new image is uploaded, use it
                    $head_logo = $_FILES["header_icon"]["name"];
                } else {
                    // If no new image, retain the existing one
                    $head_logo = $currentImage;
                }
                $result = $item->customizeIconbyId(2, $head_logo);
                if ($result) {
                    move_uploaded_file($_FILES["header_icon"]["tmp_name"], "./mvc/uploads/" . $_FILES["header_icon"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Customize');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Customize');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Customize');
        }
    }

    function customizeFooterLogo()
    {
        try {

            if (isset($_POST["footer_logo_updatebtn"])) {
                $item = $this->model('CustomizeModel');
                $data = $item->getIconbyId(2);
                foreach ($data as $row) {
                    $currentImage = $row['image'];
                }
                if (!empty($_FILES["footer_icon"]["name"])) {
                    // If a new image is uploaded, use it
                    $footer_logo = $_FILES["footer_icon"]["name"];
                } else {
                    // If no new image, retain the existing one
                    $footer_logo = $currentImage;
                }
                $result = $item->customizeIconbyId(14, $footer_logo);
                if ($result) {
                    move_uploaded_file($_FILES["footer_icon"]["tmp_name"], "./mvc/uploads/" . $_FILES["footer_icon"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Customize');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Customize');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Customize');
        }
    }

    function customizeFooterBackground()
    {
        try {

            if (isset($_POST["footer_bg_updatebtn"])) {
                $item = $this->model('CustomizeModel');
                $data = $item->getBackgroundById(8);
                foreach ($data as $row) {
                    $currentImage = $row['image'];
                }
                if (!empty($_FILES["footer_bg_image"]["name"])) {
                    $footer_bg = $_FILES["footer_bg_image"]["name"];
                } else {
                    $footer_bg = $currentImage;
                }
                $result = $item->customizeBackgroundbyId(8, $footer_bg);
                if ($result) {
                    move_uploaded_file($_FILES["footer_bg_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["footer_bg_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Customize');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Customize');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Customize');
        }
    }
}
