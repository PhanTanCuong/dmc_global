<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Auth;
use Mvc\Utils\ImageHelper;
class Post extends Controller
{

    protected $postService, $postModel, $categoryModel, $navbarModel;
    public function __construct()
    {
        Auth::checkAdmin();
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->navbarModel = $this->model('NavbarModel');
    }
    // News2
    function display()
    {
        //View
        $this->view("admin/home", [
            "news" => $this->postModel->getNews(),
            "page" => "displayMedia"
        ]);
    }

    function Update()
    {

        if (isset($_POST['checking_edit_btn'])) {
            $news_id = (int) $_POST['news_id'];
            $news = $this->postModel->getNewsbyId($news_id);
        }

        $this->view("admin/home", [
            "news" => $news,
            "category" => $this->categoryModel->getInforParentCategory(3),
            "page" => "editPost"
        ]);
    }
    

    //Edit product function

    function editNews()
    {
        try {
            if (isset($_POST["news_updatebtn"])) {
                $category_id = (int) $_POST['category'];
                $title = $_POST['edit_news_title'];
                // $slug = $_POST['edit_news_slug'];
                $short_description = $_POST['edit_news_description'];
                $long_description = $_POST['edit_news_long_description'];
                $meta_keyword = $_POST['edit_news_meta_keyword'];
                $meta_description = $_POST['edit_news_meta_description'];
                $id = $_POST['edit_news_id'];

                $data = $this->postModel->getCurrentNewsImages($id);
                $stored_image = mysqli_fetch_array($data);

                //Check image is null
                if (empty($_FILES["news_image"]['name'])) {
                    $image = $stored_image['image'];
                }

                if (ImageHelper::isImageFile($_FILES["news_image"]) === false) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:../News');
                    die();
                }
                $image = $_FILES["news_image"]['name'];



                $success = $this->postModel->editNews(
                    $id,
                    $title,
                    $short_description,
                    $long_description,
                    $image,
                    $meta_keyword,
                    $meta_description,
                    $category_id
                );
                if ($success) {

                    // $this->model("PageModel")->updateMenu($category_id,$id);

                    move_uploaded_file(
                        $_FILES["news_image"]["tmp_name"],
                        "./public/images/" . $_FILES["news_image"]["name"]
                    ) . '';
                    $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                    ImageHelper::resize_image($filepath, 389, 389);
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:../News');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:../News');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:../News');
        }
    }

    

    //delete invidual product function
    function deleteNews()
    {
        try {
            if (isset($_POST["delete_news_btn"])) {
                $id = $_POST['delete_news_id'];



                $result = $this->postModel->deleteNews($id);
                if ($result) {
                    $this->model("PageModel")->deleteMenu($id);
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

                $this->postModel->toggleCheckboxDelete($id, $visible);
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

                $result = $this->postModel->multipleDeleteNews();
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
