<?php
namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Auth;
use Mvc\Utils\ImageHelper;

class Cooperation extends Controller
{
    protected $news ;
    function __contruct()
    {
        Auth::checkAdmin();

        $this->news = $this->model('PostMedia');
    }
    function display()
    {
        try {
            if (!isset($_COOKIE['parent_id']) && (int) $_COOKIE['parent_id'] !== 73) {
                $_SESSION['status'] = 'Something went wrong!!!';
                header('Location: ' . $_ENV['BASE_URL'] . '/Admin/dashboard');
            }

            $cooperation = $this->news->getNewsByType((int) $_COOKIE['parent_id']);

            $this->view('admin/home', [
                'cooperation' => $cooperation,
                'page' => 'updateCooperation',
            ]);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function editCooperation()
    {
        try {
            if (isset($_POST["editCooperationBtn"])) {
                $title = $_POST['edit_cooperation_title'];
                $long_description = $_POST['edit_cooperation_long_description'];
                $meta_keyword = $_POST['edit_cooperation_meta_keyword'];

                $success = $this->news->editNews(
                    42,
                    $title,
                    $title,
                    $long_description,
                    null,
                    $meta_keyword,
                    $title,
                    null
                );
                if ($success) {
                    $_SESSION['success'] = 'Your data is updated';
                    header("Location:" . $_ENV['BASE_URL'] . "/Admin/Cooperation");
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header("Location:" . $_ENV['BASE_URL'] . "/Admin/Cooperation");
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header("Location:" . $_ENV['BASE_URL'] . "/Admin/Cooperation");
        }
    }
}
?>