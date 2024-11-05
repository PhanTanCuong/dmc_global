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

        $this->view("admin/home", [
            "category" => $category,
            "page" => "addPost",
        ]);
    }

    function reloadTable()
    {
        // Giả sử bạn có phương thức lấy danh sách items từ database
        $items = $this->categoryModel->getCategoryByType('post');
        // Khởi tạo một biến HTML trống
        $html = '';

        $html .= '<table class="table table-bordered" width="100%" cellspacing="0">';
        
        foreach ($items as $item) {
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= '<td><a href="javascript:void(0)" class="item-link" data-slug="' . htmlspecialchars($item['slug']) . '">' . htmlspecialchars($item['name']) . '</a></td>';
            $html .= '<td>';
            $html .= '<div class="action_column">';
            $html .= '<div>';
            $html .= '<button type="button" name="delete_btn" class="btn btn-danger delete_btn" data-id="' . htmlspecialchars($item['slug']) . '">';
            $html .= '<i class="fas fa-trash"></i>';
            $html .= '</button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '</tbody>';
        }

        $html .= '</table>';
        $html .= '</div>';

        // Trả về HTML đã tạo
        // header('Content-Type: application/json');
        echo $html;
    }

    function  reloadDiv(){
        $categories=$this->categoryModel->getInforCategory();
        $html = '<option value="0">None</option>'; 

        foreach ($categories as $category) {
            $html .= '<option value="' . htmlspecialchars($category['id']) . '">';
            $html .= htmlspecialchars($category['name']);
            $html .= '</option>';
        }


        echo $html;
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
                echo $this->postService->fetchPage($_POST["slug"]);
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}

?>