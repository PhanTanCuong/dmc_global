<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
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

    // About3
    function displayAbout3()
    {
        $item = $this->model('AboutModel');

        $this->view('admin/home', [
            'item' => $item->getInforAbout3(),
            'page' => 'about3'
        ]);
    }

    function addAbout3Info(){
        try{
            if(isset($_POST['addAbout3Btn'])){
                $title = strip_tags($_POST['about3_title']);
                $description = strip_tags($_POST['about3_description']);
                $image = $_FILES["about3_image"]['name'];

                $item= $this->model('AboutModel');
                $success= $item->addAbout3Info($title, $description, $image);
                if($success){
                    move_uploaded_file($_FILES["about3_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["about3_image"]["name"]) . '';
                    $_SESSION['success'] = 'About3 Informations are added successfully';
                    header('Location:displayAbout3');
                }else{
                    $_SESSION['status'] = 'About3 Informations are NOT  added';
                    header('Location:displayAbout3');
                }

            }
        }catch(Exception $e){
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayAbout3');

        }
    }

    //delete invidual product function
    function deleteAbout3Infor()
    {
        try {
            if (isset($_POST["delete_about3_btn"])) {
                $id = $_POST['delete_about3_id'];
                $item = $this->model('AboutModel');
                $result = $item->deleteInforAbout3($id);
                if ($result) {
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:displayAbout3');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:displayAbout3');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayAbout3');
        }
    }


    //delete multiple data functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id = null, $visible = null)
    {
        try {
            if (isset($_POST['search_data'])) {
                $id = $_POST['id'];
                $visible = $_POST['visible'];
                $item = $this->model('AboutModel');
                $item->toggleCheckboxDelete($id, $visible);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteAbout3Infor()
    function multipleDeleteInforAbout3()
    {
        try {
            if (isset($_POST['delete-multiple-data'])) {
                $item = $this->model('AboutModel');
                $result = $item->multipleDeleteInforAbout3();
                if ($result) {
                    $_SESSION['success'] = 'Your datas are deleted';
                    header('Location:displayAbout3');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:displayAbout3');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
