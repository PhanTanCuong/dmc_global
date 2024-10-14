<?php
declare(strict_types=1);

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Mvc\Services\LayoutService;
use Mvc\Utils\TypeFieldHelper;
class Layout extends Controller
{

    function display()
    {
        $layout = $this->model("LayoutModel");
        if (isset($_GET['page'])) {
            setcookie("page_id", "", time() - 3600);
            setcookie("page_id", $_GET['page'], time() + 3600);
        }

        if (isset($_GET['layout'])) {
            setcookie("layout_id", "", time() - 3600);
            setcookie("layout_id", $_GET['layout'], time() + 3600);
        }

        $this->view("admin/home", [
            "layout" => $layout->getLayout(),
            "selected_page" => $this->model("CategoryModel")->getInforParentCategory(),
            "page" => "customizeLayout",
        ]);
    }

    function addContent()
    {
        try {
            if (!isset($_POST["addContentBtn"])) {
                throw new Exception("Layout not found");
            }
            $pageId = (int) $_COOKIE["page_id"];
            $layoutId = (int) $_COOKIE["layout_id"];

            $LayoutService = new LayoutService($this->model('ContentModel'));

            $result = false;
            //add input fields except image field
            $result = $LayoutService->addContent($_POST, $layoutId);

            //add image fields
            if (isset($_FILES["image"]['name'])) {
                $image = $_FILES["image"]['name'];
                $result = $LayoutService->addImageField($image, $layoutId);
            }


            $result = $this->model("LayoutModel")->addPagelayout($pageId, $layoutId);

            if ($result === true) {
                $_SESSION['success'] = "Data saved successfully";
                header("Location: layout");
            } else {
                $_SESSION['status'] = "Data  did NOT save successfully";
                header("Location: layout");
            }


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
?>