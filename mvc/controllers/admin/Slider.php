<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
use Mvc\Libraries\Image;
class Slider extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('SliderModel');
        $product_category = $this->model('CategoryModel');
        if (isset($_GET['product_category_id'])) {
            setcookie("product_category_id", "", time() - 3600);
            setcookie("product_category_id", $_GET['product_category_id'], time() + 3600);
            $product_category_id = $_GET['product_category_id'];
        } else {
            $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;
        }

        $this->view('admin/home', [
            'product_categories' => $product_category->getInforCategory(),
            'item' => $item->getInforBanner($product_category_id),
            'page' => 'customizeBanner'
        ]);
    }

    //Customize banner information
    function addBanner()
    {
        try {

            if (isset($_POST["banner_updatebtn"])) {
                $title = strip_tags($_POST['banner_title']);
                $description = strip_tags($_POST['banner_description']);
                $item = $this->model('SliderModel');
                $image = $_FILES["banner_image"]['name'];

                if (Image::isImageFile($_FILES["banner_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:Slider');
                    die();
                }
                $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;

                $success = $item->addInforbanner($title, $description, $image, $product_category_id);
                if ($success) {
                    move_uploaded_file($_FILES["banner_image"]["tmp_name"], "./public/images/" . $_FILES["banner_image"]["name"]) . '';
                    $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                    Image::resize_image($filepath, 1920, 860);
                    $_SESSION['success'] = 'Your data is added successfully';
                    header('Location:Slider');
                } else {
                    $_SESSION['status'] = 'Your data is NOT added successfully';
                    header('Location:Slider');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Slider');
        }
    }

    //getBannerById()
    function getBannerById()
    {
        if (isset($_POST['checking_edit_btn'])) {
            $item_id = $_POST['banner_id'];
            $result_array = [];
            $item = $this->model('SliderModel');
            $result = $item->getBannerInforById($item_id);
            if (mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);
                }
            }
        }
    }

    //edit Banner
    function customizeBanner()
    {

        try {
            if (isset($_POST["editBannerBtn"])) {
                $title = $_POST['edit_title'];
                $description = $_POST['edit_description'];
                $id = $_POST['edit_id'];
                $item = $this->model('SliderModel');
                $result = $item->getBannerInforById($id);
                $data = mysqli_fetch_assoc($result);
                    $currentImage = $data['image'];
                if (!empty($_FILES["banner_image"]['name'])) {
                    if (Image::isImageFile($_FILES["banner_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Please upload a correct image type ';
                        header('Location:Slider');
                        die();
                    }
                    $image = $_FILES["banner_image"]['name'];
                } else {
                    $image = $currentImage;
                }


                $success = $item->customizeInforBanner($id, $title, $description, $image);
                if ($success) {
                    move_uploaded_file($_FILES["banner_image"]["tmp_name"], "./public/images/" . $_FILES["banner_image"]["name"]);
                    $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                    Image::resize_image($filepath, 1920, 860);
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Slider');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Slider');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Slider');
        }
    }


    //delete Banner
    function deleteBanner()
    {
        try {
            if (isset($_POST["delete_btn"])) {
                $id = $_POST['delete_id'];
                $item = $this->model('SliderModel');
                $result = $item->deleteInforBanner($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Slider');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Slider');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Slider');
        }
    }

}
