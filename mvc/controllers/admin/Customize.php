<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;
use Mvc\Libraries\Image;
class Customize extends Controller
{
    function __construct()
    {
        Middleware::checkAdmin();
    }

    function display()
    {
        $item = $this->model('CustomizeModel');
        $icons = $this->model('IconsModel');
        $category = $this->model('CategoryModel');
        $navbar_item=$this->model('NavbarModel');

        $this->view('admin/home', [
            "page" => 'customizeContent',
            "head" => $item->getHeadInfor(),
            "header_icon" => $item->getIconbyId(2),
            "footer_icon" => $item->getIconbyId(14),
            "bg_footer" => $item->getBackgroundbyId(8),
            "item" => $item->getDataFooter(),
            "footer_icons" => $icons->getInforIcons(7),
            "category" => $item->getAvailableItems(23,12),
            "navbar_item"=>$item->getAvailableQuickLink(13),
            "selected_product_category_items"=>$item->fetchSelectedItem(12),
            "selected_quick_link_items"=>$item->fetchSelectedItem(13),
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
                }
                if (!empty($_FILES["head_image"]["name"])) {
                    if (Image::isImageFile($_FILES["head_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type ';
                        header('Location:Customize');
                        die();
                    }
                    $image = $_FILES["head_image"]["name"];
                } else {
                    $image = $currentImage;
                }

                $success = $item->customizeHeaderInfor($name, $image);
                if ($success) {
                    move_uploaded_file($_FILES["head_image"]["tmp_name"], "./public/images/" . $_FILES["head_image"]["name"]) . '';
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
                    if (Image::isImageFile($_FILES["header_icon"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type ';
                        header('Location:Customize');
                        die();
                    }
                    $head_logo = $_FILES["header_icon"]["name"];

                } else {
                    $head_logo = $currentImage;
                }
                $result = $item->customizeIconbyId(2, $head_logo);
                if ($result) {
                    move_uploaded_file($_FILES["header_icon"]["tmp_name"], "./public/images/" . $_FILES["header_icon"]["name"]) . '';
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
                    if (Image::isImageFile($_FILES["footer_icon"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type ';
                        header('Location:Customize');
                        die();
                    }
                    $footer_logo = $_FILES["footer_icon"]["name"];
                } else {
                    $footer_logo = $currentImage;
                }
                $result = $item->customizeIconbyId(14, $footer_logo);
                if ($result) {
                    move_uploaded_file($_FILES["footer_icon"]["tmp_name"], "./public/images/" . $_FILES["footer_icon"]["name"]) . '';
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
                    if (Image::isImageFile($_FILES["footer_bg_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type ';
                        header('Location:Customize');
                        die();
                    }
                    $footer_bg = $_FILES["footer_bg_image"]["name"];
                } else {
                    $footer_bg = $currentImage;
                }
                $result = $item->customizeBackgroundbyId(8, $footer_bg);
                if ($result) {
                    move_uploaded_file($_FILES["footer_bg_image"]["tmp_name"], "./public/images/" . $_FILES["footer_bg_image"]["name"]) . '';
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

    //Footer data
    function getDataById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['data_id'];
            $result_array = [];
            $item = $this->model('CustomizeModel');
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

    function editFooterData()
    {
        try {

            if (isset($_POST["editDataBtn"])) {
                $title = strip_tags($_POST['edit_title']);
                $description = strip_tags($_POST['edit_description']);
                $id = $_POST['edit_id'];
                $item = $this->model('CustomizeModel');

                $success = $item->editData($id, $title, $description);
                if ($success) {
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

    function customizeQuickLink()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedItems'])) {
                    $selectedItems = json_decode($_POST['selectedItems'],true);
                    $id=(int)$_POST['quick_link_id'];
                        
                    $data = $this->model('DataModel');
                    $success = $data->storedSelectedItems($selectedItems,$id);
                    if ($success) {
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
