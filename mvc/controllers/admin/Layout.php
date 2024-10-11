<?php
namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
class  Layout extends Controller{

    function display(){
        $layout=$this->model("LayoutModel");

        $this->view("admin/home",[
            "layout"=>$layout->getLayout(),
            "selected_page"=>$this->model("CategoryModel")->getInforParentCategory(),
            "page"=>"customizeLayout",
        ]);
    }

}
?>