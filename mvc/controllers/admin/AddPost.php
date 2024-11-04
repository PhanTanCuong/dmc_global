<?php
namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Auth;

class AddPost extends Controller
{

    protected $postModel, $navabrModel, $categoryModel, $postService;
    public function __construct()
    {
        Auth::checkAdmin();
        $this->postModel = $this->model('PostModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->postService = new \Mvc\Services\PostService(
            $this->postModel,
            $this->model('PageModel'),
            $this->model('NavbarModel'),
            $this->categoryModel,
        );

    }

    function display()
    {
        $category = $this->categoryModel->getCategoryByType('post');
        // Kiểm tra nếu yêu cầu là AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            // dd($category);
            // Nếu là AJAX, trả về dữ liệu JSON để refresh bảng
            header('Content-Type: application/json');
            // Chuyển dữ liệu thành JSON, kiểm tra lỗi JSON trước khi gửi
            $jsonData = json_encode(["category" => $category]);
            // dd($jsonData);
            if (json_last_error() === JSON_ERROR_NONE) {
                echo $jsonData;
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Error encoding JSON data."
                ]);
            }
            return;
        }

        $this->view("admin/home", [
            "category" => $this->categoryModel->getInforCategory(),
            "item" => $category,
            "page" => "addPost",
        ]);
    }

    //Add news function
    function addNews()
    {
        //Model
        try {
            if (isset($_POST['action']) && $_POST['action'] === "add_record") {
                header('Content-Type: application/json');
                echo $this->postService->addPost();
            }

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    //Delete news function
    function deletePost()
    {
        try {
            if (isset($_GET['action']) && $_GET['action'] === "delete_data") {
                header('Content-Type: application/json');
                echo $this->postService->deletePost($_GET['id']);
            }
        } catch (\Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }


    //Edit Post
    function editPost(){
        try{
            if(isset($_POST['action']) && $_POST['action']==="edit_record"){
                header('Content-Type:application/json');
                echo $this->postService->updatePost();
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    
    //Fetch post
    function fetchPost()
    {
        try {
            if (isset($_POST['slug'])) {
                //send JSON response back to AJAX
                header('Content-Type: application/json');
                echo $this->postService->fetchPage($_POST['slug']);
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}

?>