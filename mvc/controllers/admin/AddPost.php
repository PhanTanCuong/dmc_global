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
            // Nếu là AJAX, trả về dữ liệu JSON để refresh bảng
            header('Content-Type: application/json');
            echo json_encode([
                "category" => $category
            ]);
            return;
        }

        $this->view("admin/home", [
            "category" => $category,
            'item' => $category,
            "page" => "addPost",
        ]);
    }

    //Add new product function
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
}

?>