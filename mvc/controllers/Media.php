<?php
class Media extends Controller
{
    function displayNews()
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
    public function displayDetailNews()
    {
        try{
            if(isset($_POST["display_news_infor_btn"])){
                $news = $this->model("MediaModel");
                $this->view("admin/home", [
                    "news" => $news->getNewsbyId($_POST['edit_news_id']),
                    "page" => "editMedia"
                ]);
            }
        }catch(Exception $e){
            echo $e->getMessage();
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
                //     header('Location:displayNews');
                // } else {
                    $news = $this->model("MediaModel");
                    $result = $news->addNews($title, $description, $link, $image);
                    if ($result) {
                        //Upload image data vào folder upload
                        move_uploaded_file($_FILES["news_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["news_image"]["name"]) . '';
                        $_SESSION['success'] = "News is added successfully";
                        header('Location:displayNews');
                    } else {
                        $_SESSION['status'] = "News is NOT added";
                        header('Location:displayNews');
                    }
                // }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:displayNews');
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
                $image = $_FILES["news_image"]['name'];
                $id = $_POST['edit_news_id'];
                $news = $this->model('MediaModel');
                $success = $news->editNews($id, $title, $description, $link, $image);
                if ($success) {
                    move_uploaded_file($_FILES["news_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["news_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayNews');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:displayNews');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayNews');
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
                    header('Location:displayNews');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:displayNews');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayNews');
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
                    header('Location:displayNews');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:displayNews');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
