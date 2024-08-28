<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Slider extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('SliderModel');
        $product_category = $this->model('ProductModel');
        if (isset($_GET['product_category_id'])) {
            setcookie("product_category_id", "", time() - 3600);
            setcookie("product_category_id", $_GET['product_category_id'], time() + 3600);
            $product_category_id = $_GET['product_category_id'];
        } else {
            $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;
        }

        $this->view('admin/home', [
            'product_categories' => $product_category->getInforProductCategory(),
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
                if (!$this->isImageFile($image)) {
                    $_SESSION['status'] = 'Wrong type image file';
                    header('Location:Slider');
                }
                $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;

                $success = $item->addInforbanner($title, $description, $image, $product_category_id);
                if ($success) {
                    move_uploaded_file($_FILES["banner_image"]["tmp_name"], "./public/images/" . $_FILES["banner_image"]["name"]) . '';
                    $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                    $this->resize_image($filepath, 1920, 860);
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
                    $image = $_FILES["banner_image"]['name'];
                } else {
                    $image = $currentImage;
                }
                $success = $item->customizeInforBanner($id, $title, $description, $image);
                if ($success) {
                    move_uploaded_file($_FILES["banner_image"]["tmp_name"], "./public/images/" . $_FILES["banner_image"]["name"]);
                    $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                    $this->resize_image($filepath, 1920, 860);
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

    public function resize_image($file, $newWidth, $newHeight)
    {
        try {
            if (file_exists($file)) {
                // echo "File path: " . $file;
                $info = getimagesize($file);
                $mime = $info['mime'];//MIME (Multipurpose Internet Mail Extensions)
                switch ($mime) {
                    case 'image/jpeg':
                        $original_image = imagecreatefromjpeg($file);
                        break;
                    case 'image/png':
                        $original_image = imagecreatefrompng($file);
                        break;
                    case 'image/gif':
                        $original_image = imagecreatefromgif($file);
                        break;
                    default:
                        throw new Exception('Unsupported image format');
                }

                // Lấy kích thước cũ của ảnh(resolution)
                $original_width = imagesx($original_image);
                $original_height = imagesy($original_image);

                // //Làm chiều dài trước
                // $ratio = $max_resolution / $original_width;
                // $new_width = $max_resolution;
                // $new_height = $original_height * $ratio;

                // if ($new_height > $max_resolution) {
                //     $ratio = $max_resolution / $original_height;
                //     $new_width = $original_width * $ratio;
                //     $new_height = $max_resolution;
                // }


                // Tạo ảnh mới với kích thước mới
                $newImage = imagecreatetruecolor($newWidth, $newHeight);

                // Sao chép và thay đổi kích thước ảnh cũ sang ảnh mới
                imagecopyresampled(
                    $newImage,
                    $original_image,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $original_width,
                    $original_height
                );

                // Lưu ảnh mới
                switch ($mime) {
                    case 'image/jpeg':
                        imagejpeg($newImage, $file, 90);
                        break;
                    case 'image/png':
                        imagepng($newImage, $file);
                        break;
                    case 'image/gif':
                        imagegif($newImage, $file);
                        break;
                }

                // Giải phóng bộ nhớ
                imagedestroy($original_image);
                imagedestroy($newImage);
            } else {
                throw new Exception('File does not exist');
            }
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }

    public function isImageFile($file)
    {
        // Check if the file is uploaded and exists
        if (isset($file) && file_exists($file['tmp_name'])) {
            // Get image size and type information
            $info = getimagesize($file['tmp_name']);

            // If getimagesize returns false, it's not a valid image
            if ($info === false) {
                return false;
            }

            // Validate the MIME type to ensure it's an image
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($info['mime'], $validMimeTypes)) {
                return true;
            }
        }

        return false;
    }
}
