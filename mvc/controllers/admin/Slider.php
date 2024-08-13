<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
class Slider extends Controller 
{     public function __construct()
    {
        Middleware::checkAdmin();
    }
    function display()
    {
        $item = $this->model('SliderModel');

        $this->view('admin/home', [
            'item' => $item->getInforBanner(),
            'page' => 'customizeBanner'
        ]);
    }

     //Customize banner information
     function customBanner()
     {
         try {
 
             if (isset($_POST["banner_updatebtn"])) {
                 $title = strip_tags($_POST['banner_title']);
                 $description = strip_tags($_POST['banner_description']);
 
                 $item = $this->model('SliderModel');
                 $data=$item->getCurrentBannerImages();
 
                 $currentImages=mysqli_fetch_array($data);
 
                 //Check image is null
                 if(!empty($_FILES["banner_image"]['name'])){
                     $image = $_FILES["banner_image"]['name'];
                 }else{
                     $image=$currentImages['image'];
                 }
                
 
                 $success=$item->customizeInforBanner($title,$description,$image);
                 if ($success) {
                     move_uploaded_file($_FILES["banner_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["banner_image"]["name"]) . '';
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
