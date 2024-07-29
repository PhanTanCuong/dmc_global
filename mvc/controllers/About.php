<?php
class About extends Controller
{   
    function displayBanner()
    {
        $item = $this->model('AboutModel');

        $this->view('admin/home', [
            'item' => $item->getInforBanner(),
            'page' => 'banner'
        ]);
    }

     //Customize about2 information
     function customBanner()
     {
         try {
 
             if (isset($_POST["banner_updatebtn"])) {
                 $title = strip_tags($_POST['banner_title']);
                 $description = strip_tags($_POST['banner_description']);
 
                 $item = $this->model('AboutModel');
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
                     header('Location: displayBanner');
                 } else {
                     $_SESSION['status'] = 'Your data is NOT updated';
                     header('Location:displayBanner');
                 }
             }
         } catch (Exception $e) {
             $_SESSION['status'] = $e->getMessage();
             header('Location:displayBanner');
         }
     }

    // about2
    function displayAbout2()
    {
        $item = $this->model('AboutModel');

        $this->view('admin/home', [
            'item' => $item->getInforAbout2(),
            'page' => 'about2'
        ]);
    }

    //Customize about2 information
    function customAbout2()
    {
        try {

            if (isset($_POST["about2_updatebtn"])) {
                $title = strip_tags($_POST['about2_title']);
                $description = strip_tags($_POST['about2_description']);

                $item = $this->model('AboutModel');
                $data=$item->getCurrentAbout2Images();

                $currentImages=mysqli_fetch_array($data);

                //Check image is null
                if(!empty($_FILES["about2_image"]['name'])){
                    $image = $_FILES["about2_image"]['name'];
                }else{
                    $image=$currentImages['image'];
                }

                 //Check image is null
                 if(!empty($_FILES["about2_child_image"]['name'])){
                    $child_image = $_FILES["about2_child_image"]['name'];
                }else{
                    $child_image=$currentImages['child_image'];
                }
               

                $success=$item->customizeInforAbout2($title,$description,$image,$child_image);
                if ($success) {
                    move_uploaded_file($_FILES["about2_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["about2_image"]["name"]) . '';
                    move_uploaded_file($_FILES["about2_child_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["about2_child_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayAbout2');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:displayAbout2');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayAbout2');
        }
    }


}
