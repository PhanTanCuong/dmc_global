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


    function displayAddNews(){

        if(isset($_COOKIE['parent_id'])){
            $parent_id=(int)$_COOKIE['parent_id'];
            $categories=$this->model('CategoryModel')->getCategory($parent_id);
        }
        $this->view("admin/home",[
            "product_categories"=>$categories,
            "page"=>"addPost"
        ]);
    }

    function Update(){
        if(isset($_COOKIE['parent_id'])){
            $parent_id=(int)$_COOKIE['parent_id'];
            $categories=$this->model('CategoryModel')->getCategory($parent_id);
        }
        
        if (isset($_POST['checking_edit_btn'])) {
            $news_id = (int)$_POST['news_id'];
            $news=$this->model('MediaModel')->getNewsbyId($news_id);
        }
        
        $this->view("admin/home",[
            "news"=> $news,
            "product_categories"=>$categories,
            "page"=>"editPost"
        ]);
    }
    //Add new product function
    function addNews()
    {
        //Model
        try {
            if (isset($_POST['addNewsBtn'])) {
                //Input fields
                $category_id=$_POST['category'];
                $title = $_POST['news_title'];
                $slug = $_POST['news_slug'];
                $short_description =$_POST['news_description'];
                $long_description=$_POST['news_long_description'];
                $meta_keyword=$_POST['news_meta_keyword'];
                $meta_description=$_POST['news_meta_description'];
                $image = $_FILES["news_image"]['name'];

                //Check if image is an image file
                if (Image::isImageFile($_FILES["news_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:../News');
                    die();
                }

                if(isset($_COOKIE['parent_id'])){
                    $type_id=(int)$_COOKIE['parent_id'];
                }else{
                    $_SESSION['status'] = "ID isexpired";
                    header('Location:Add');
                    die();
                }

                //Model
                $news = $this->model("MediaModel");

                $preference_id = $news->addNews($title, $short_description,$long_description,$slug,$image,$meta_keyword,$meta_description,$category_id,$type_id);
                if (is_numeric($preference_id) && $preference_id>0) {

                   

                    //add to slug center
                    $this->model('MenuModel')->addMenu($slug,$preference_id,$category_id);
                    
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./public/images/" . $_FILES["news_image"]["name"]) . '';
                    
                    $_SESSION['success'] = "News is added successfully";
                    header('Location:../News');
                } else {
                    $_SESSION['status'] = "News is NOT added";
                    header('Location:Add');
                }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:Add');
        }
    }

    //Edit product function

    function editNews()
    {
        try {
            if (isset($_POST["news_updatebtn"])) {
                $title = $_POST['edit_news_title'];
                $slug = $_POST['edit_news_slug'];
                $short_description =$_POST['edit_news_description'];
                $long_description=$_POST['edit_news_long_description'];
                $meta_keyword=$_POST['edit_news_meta_keyword'];
                $meta_description=$_POST['edit_news_meta_description'];
                $id = $_POST['edit_news_id'];

                $news = $this->model('MediaModel');

                $data = $news->getCurrentNewsImages($id);
                $stored_image = mysqli_fetch_array($data);

                //Check image is null
                if (!empty($_FILES["news_image"]['name'])) {
                    if (Image::isImageFile($_FILES["news_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type';
                        header('Location:../News');
                        die();
                    }
                    $image = $_FILES["news_image"]['name'];
                } else {
                    $image = $stored_image['image'];
                }
                $success = $news->editNews($id, $title, $short_description,$long_description,$slug,$image,$meta_keyword,$meta_description);
                if ($success) {

                    // $this->model('MenuModel')->updateMenu($slug,$category_id,$id);
                    
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./public/images/" . $_FILES["news_image"]["name"]) . '';
                    
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:../News');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Update');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Update');
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
                    $this->model('MenuModel')->deleteMenu($id);
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
