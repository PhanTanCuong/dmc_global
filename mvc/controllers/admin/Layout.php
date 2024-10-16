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
            setcookie("page_id", "", time() - 60*60*1000);
            setcookie("page_id", $_GET['page'], time() + 60*60*1000);
        }

        if (isset($_GET['layout'])) {
            setcookie("layout_id", "", time() - 60*60*1000);
            setcookie("layout_id", $_GET['layout'], time() + 60*60*1000);
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
            $pageId = (int) $_COOKIE["page_id"];
            $layoutId = (int) $_COOKIE["layout_id"];

            $LayoutService = new LayoutService($this->model('ContentModel'));

            $result = false;
      
            $result = $LayoutService->addContent($_POST, $layoutId);

            //add image fields


            $saveResult = $this->model("LayoutModel")->addPagelayout($pageId, $layoutId);

            if ($result === true && $saveResult === true) {
                // Nếu thành công
                echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
            } else {
                // Nếu lỗi
                echo json_encode(['success' => false, 'message' => 'Data did not save successfully']);
            }


        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

}
?>