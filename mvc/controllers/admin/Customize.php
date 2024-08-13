<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;
use Core\Middleware;

class Customize extends Controller
{
    function __construct()
    {
        Middleware::checkAdmin();
    }

    function display(){
        $item = $this->model('CustomizeModel');

        $this->view('admin/home', [
            'page'=>'customizeContent',
            'about2' => $item->getAbout2Infor(),
            'product1' => $item->getProduct1Infor()
        ]);
    }

    function customizeAbout2()
    {
        try {

            if (isset($_POST["about2_updatebtn"])) {
                $title = strip_tags($_POST['about2_title']);
                $description = strip_tags($_POST['about2_description']);

                $item = $this->model('CustomizeModel');
                $data=$item->getCurrentAbout2Images();

                $currentImages=mysqli_fetch_array($data);
                
                if(!empty($_FILES["about2_parent_image"]['name'])){
                    $parent_image = $_FILES["about2_parent_image"]['name'];
                }else{
                    $parent_image=$currentImages['parent_image'];
                }
               

                if(!empty($_FILES["about2_child_image"]['name'])){
                    $child_image = $_FILES["about2_child_image"]['name'];
                }else{
                    $child_image=$currentImages['child_image'];
                }
               
                $success=$item->customizeInforAbout2($title,$description,$parent_image,$child_image);
                if ($success) {
                    move_uploaded_file($_FILES["about2_parent_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["about2_parent_image"]["name"]) . '';
                    move_uploaded_file($_FILES["about2_child_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["about2_child_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:Slider');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:Slider');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Slider');
        }
    }

}
