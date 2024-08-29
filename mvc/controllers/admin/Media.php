<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
use Mvc\Libraries\Image;
class Media extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    // News2
    function display()
    {
        //Model
        $news = $this->model("MediaModel");

        //View
        $this->view("admin/home", [
            "news" => $news->getNews(),
            "page" => "displayMedia"
        ]);
    }

    //display detail infor user account
    function getNewsById()
    {
        if(isset($_POST['checking_edit_btn'])) {
            $news_id=$_POST['news_id'];
            $result_array=[];
            $news= $this->model('MediaModel');
            $result = $news->getNewsbyId($news_id);
            if(mysqli_num_rows($result) > 0) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                    header('Content-Type: application/json');
                    echo json_encode($result_array);

                }

            }
        }
    }

    //Add new product function
    function addNews()
    {
        //Model
        try {
            if (isset($_POST['addNewsBtn'])) {
                $title = strip_tags($_POST['news_title']);
                $description = strip_tags($_POST['news_description']);
                $link = strip_tags($_POST['news_link']);
                $image = $_FILES["news_image"]['name'];
                if (Image::isImageFile($_FILES["news_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Please upload a pdf or an image ';
                    header('Location:News');
                    die();
                }
                $news = $this->model("MediaModel");
                $result = $news->addNews($title, $description, $link, $image);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./public/images/" . $_FILES["news_image"]["name"]) . '';
                    $_SESSION['success'] = "News is added successfully";
                    header('Location:News');
                } else {
                    $_SESSION['status'] = "News is NOT added";
                    header('Location:News');
                }
                // }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:News');
        }
    }

    //Edit product function

    function editNews()
    {
        try {

            if (isset($_POST["news_updatebtn"])) {
                $title = strip_tags($_POST['news_title']);
                $description = strip_tags($_POST['news_description']);
                $link = strip_tags($_POST['news_link']);

                $id = $_POST['edit_news_id'];
                $news = $this->model('MediaModel');

                $data = $news->getCurrentNewsImages($id);
                $stored_image = mysqli_fetch_array($data);
                if (Image::isImageFile($_FILES["news_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Please upload a pdf or an image ';
                    header('Location:News');
                    die();
                }
                //Check image is null
                if (!empty($_FILES["news_image"]['name'])) {
                    $image = $_FILES["news_image"]['name'];
                } else {
                    $image = $stored_image['image'];
                }
                $success = $news->editNews($id, $title, $description, $link, $image);
                if ($success) {
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./public/images/" . $_FILES["news_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:News');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:News');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:News');
        }
    }

    //delete invidual product function
    function deleteNews()
    {
        try {
            if (isset($_POST["delete_news_btn"])) {
                $id = $_POST['delete_news_id'];
                $news = $this->model('MediaModel');
                $result = $news->deleteNews($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:News');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:News');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:News');
        }
    }


    //delete multiple products functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id = null, $visible = null)
    {
        try {
            if (isset($_POST['search_data'])) {
                $id = $_POST['id'];
                $visible = $_POST['visible'];
                $news = $this->model('MediaModel');
                $news->toggleCheckboxDelete($id, $visible);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteNews()
    function multipleDeleteNews()
    {
        try {
            if (isset($_POST['delete-multiple-data'])) {
                $news = $this->model('MediaModel');
                $result = $news->multipleDeleteNews();
                if ($result) {
                    $_SESSION['success'] = 'Your products are deleted';
                    header('Location:News');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:News');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
