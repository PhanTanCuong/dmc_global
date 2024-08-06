<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Media extends Controller
{
    public function __construct()
    {
        Middleware::checkAdmin();
    }
    // News1
    function displayNews1()
    {
        $data = $this->model("MediaModel");

        $this->view("admin/home", [
            "background" => $data->getNews1(),
            "icon" => $data->getIconMedia1(),
            "page" => "media1"
        ]);
    }

    function editStatBackground()
    {
        try {
            if (isset($_POST["background_updatebtn"])) {
                $item = $this->model('MediaModel');
                //backgrond
                $data = $item->getCurrentBackgroundMedia1();
                $currentBgImage = mysqli_fetch_assoc($data);

                if (!empty($_FILES["background_image"]['name'])) {
                    $bg_image = $_FILES["background_image"]['name'];
                } else {
                    $bg_image = $currentBgImage['image'];
                }
                $success_bg = $item->editBackgroundMedia1($bg_image);
                if ($success_bg) {
                    move_uploaded_file($_FILES["background_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["background_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayNews1');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: displayNews1');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:News1');
        }
    }


    function addStateIcon()
    {
        try {
            if (isset($_POST['addStateIconBtn'])) {
                $name = strip_tags($_POST['icon_name']);
                $value = strip_tags($_POST['icon-value']);
                $image = $_FILES["icon_image"]['name'];

                $success = $this->model('MediaModel')->saveIconMeida1($name, $value, $image);
                if ($success) {
                    move_uploaded_file($_FILES["icon_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["icon_image"]["name"]);
                    $_SESSION["success"] = "Your data is added";
                    header("Location:News1");
                } else {
                    $_SESSION["status"] = "Your data is NOT added";
                    header("Location:News1");
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:News1');
        }
    }


    function deleteStateIcon()
    {
        try {
            if (isset($_POST["delete_icon_btn"])) {
                $id = $_POST["delete_icon_id"];

                $item = $this->model('MediaModel');
                $success = $item->deleteIconMedia1($id);
                if ($success) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location: displayNews1');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location: displayNews1');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function updateIconMedia()
    {
        try {
            if (isset($_POST["delete_ic_btn"])) {
                $id = $_POST["icon_media_id"];
                //Icons
                $icon_media_name = $_POST['icon_media_name'];
                $icon_media_value = $_POST['icon_media_value'];
                $item = $this->model('MediaModel');
                $data = $item->getIconMedia1();
                $currentIcImage = mysqli_fetch_assoc($data);


                if (!empty($_FILES["icon_media_image"]['name'])) {
                    $icon_media_image = $_FILES["icon_media_image"]['name'];
                } else {
                    $icon_media_image = $currentIcImage['image'];
                }
                $success = $item->updateIconMedia1($id, $icon_media_name, $icon_media_value, $icon_media_image);
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayNews1');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: displayNews1');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //delete multiple data functions

    //toggleCheckbox()
    function toggleCheckboxDeleteStateIcon($id = null, $visible = null)
    {
        try {
            if (isset($_POST['search_data'])) {
                $id = $_POST['id'];
                $visible = $_POST['visible'];
                $item = $this->model('MediaModel');
                $item->toggleCheckboxDelete($id, $visible);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteAbout3Infor()
    function multipleDeleteStateIcon()
    {
        try {
            if (isset($_POST["deletemultipledata"])) {
                $item = $this->model('MediaModel');
                $result = $item->multipleDeleteStateIcon();
                if ($result) {
                    $_SESSION['success'] = 'Your datas are deleted';
                    header('Location:News1');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:News1');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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
    function addNews($title = null, $description = null, $link = null, $image = null)
    {
        //Model
        try {
            if (isset($_POST['addNewsBtn'])) {
                $title = strip_tags($_POST['news_title']);
                $description = strip_tags($_POST['news_description']);
                $link = strip_tags($_POST['news_link']);
                $image = $_FILES["news_image"]['name'];
                // $_FILES["news_image"]['name']:gán giá trị cho biến.


                //Kiểm tra xem ảnh có tồn tại trong kho lưu trữ ko
                // if (file_exists("./mvc/uploads/" . $_FILES["news_image"]["name"])) {
                //     $image_store = $_FILES["news_image"]["name"];
                //     //$_FILES["news_image"]["name"]: truy cập trực tiếp vào phần tử name của mảng $_FILES["news_image"].
                //     $_SESSION['status'] = "Image is already exists " . $image_store . "!";
                //     header('Location:News');
                // } else {
                $news = $this->model("MediaModel");
                $result = $news->addNews($title, $description, $link, $image);
                if ($result) {
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["news_image"]["name"]) . '';
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

                //Check image is null
                if (!empty($_FILES["news_image"]['name'])) {
                    $image = $_FILES["news_image"]['name'];
                } else {
                    $image = $stored_image['image'];
                }
                $success = $news->editNews($id, $title, $description, $link, $image);
                if ($success) {
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["news_image"]["name"]) . '';
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
