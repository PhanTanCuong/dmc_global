<?php

namespace Mvc\Controllers\Admin;
use Core\Controller;
use Core\Exception;
use Core\Middleware;
use Mvc\Libraries\Image;
class Product extends Controller
{

    public function __construct()
    {
        Middleware::checkAdmin();
    }
  

    //Load list of products layout
    function display()
    {
        //Model
        $product = $this->model("ProductModel");

        //View
        $this->view("admin/home", [
            "product" => $product->getProduct(),
            "page" => "displayProduct"
        ]);
    }

    function displayAddProduct(){

        if(isset($_COOKIE['parent_id'])){
            $parent_id=(int)$_COOKIE['parent_id'];
            $categories=$this->model('CategoryModel')->getCategory($parent_id);
        }
        $this->view("admin/home",[
            "product_categories"=>$categories,
            "page"=>"addProduct"
        ]);
    }

    function Update(){
        if(isset($_COOKIE['parent_id'])){
            $parent_id=(int)$_COOKIE['parent_id'];
            $categories=$this->model('CategoryModel')->getCategory($parent_id);
        }
        
        if (isset($_POST['checking_edit_btn'])) {
            $product_id = (int)$_POST['product_id'];
            $product=$this->model('ProductModel')->getProductbyId($product_id);
        }
        
        $this->view("admin/home",[
            "product"=> $product,
            "product_categories"=>$categories,
            "page"=>"editProduct"
        ]);
    }
    //Add new product function
    function addProduct()
    {
        //Model
        try {
            if (isset($_POST['addProductBtn'])) {
                //Input fields
                $category_id=$_POST['category'];
                $title = $_POST['product_title'];
                $slug = $_POST['product_slug'];
                $short_description =$_POST['product_description'];
                $long_description=$_POST['product_long_description'];
                $meta_keyword=$_POST['product_meta_keyword'];
                $meta_description=$_POST['product_meta_description'];
                $image = $_FILES["product_image"]['name'];

                //Check if image is an image file
                if (Image::isImageFile($_FILES["product_image"]) === is_bool('')) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:../Product');
                    die();
                }

                if(isset($_COOKIE['parent_id'])){
                    $type_id=(int)$_COOKIE['parent_id'];
                }else{
                    $_SESSION['status'] = "ID isexpired";
                    header('Location:Add');
                    die();
                }

                //Model
                $product = $this->model("ProductModel");

                $preference_id = $product->addProduct($title, $short_description,$long_description,$slug,$image,$meta_description,$meta_keyword,$category_id,$type_id);
                if (is_numeric($preference_id) && $preference_id>0) {

                   

                    //add to slug center
                    $this->model('MenuModel')->addMenu($slug,$preference_id,$category_id);
                    
                    //Upload image data vào folder upload
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./public/images/" . $_FILES["product_image"]["name"]) . '';
                    
                    $_SESSION['success'] = "Product is added successfully";
                    header('Location:../Product');
                } else {
                    $_SESSION['status'] = "Product is NOT added";
                    header('Location:../Product');
                }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:../Product');
        }
    }

    //Edit product function

    function editProduct()
    {
        try {
            if (isset($_POST["product_updatebtn"])) {
                $category_id=(int)$_POST['category'];
                $title = $_POST['edit_product_title'];
                $slug = $_POST['edit_product_slug'];
                $short_description =$_POST['edit_product_description'];
                $long_description=$_POST['edit_product_long_description'];
                $meta_keyword=$_POST['edit_product_meta_keyword'];
                $meta_description=$_POST['edit_product_meta_description'];
                $id = $_POST['edit_product_id'];

                $product = $this->model('ProductModel');

                $data = $product->getCurrentProductImages($id);
                $stored_image = mysqli_fetch_array($data);

                //Check image is null
                if (!empty($_FILES["product_image"]['name'])) {
                    if (Image::isImageFile($_FILES["product_image"]) === is_bool('')) {
                        $_SESSION['status'] = 'Incorrect image type';
                        header('Location:../Product');
                        die();
                    }
                    $image = $_FILES["product_image"]['name'];
                } else {
                    $image = $stored_image['image'];
                }
                $success = $product->editProduct($id, $title, $short_description,$long_description,$image,$meta_keyword,$meta_description,$category_id);
                if ($success) {

                    $this->model('MenuModel')->updateMenu($category_id,$id);
                    
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./public/images/" . $_FILES["product_image"]["name"]) . '';
                    
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location:../Product');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location:../Product');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:../Product');
        }
    }

    //delete invidual product function
    function deleteProduct()
    {
        try {
            if (isset($_POST["delete_product_btn"])) {
                $id = $_POST['delete_product_id'];
                
                $product = $this->model('ProductModel');
                
                $result = $product->deleteProduct($id);
                if ($result) {
                    $this->model('MenuModel')->deleteMenu($id);
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:Product');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:Product');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:Product');
        }
    }




    //delete multiple products functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id, $visible)
    {
        try {
            if (isset($_POST['search_data'])) {
                $id = $_POST['id'];
                $visible = $_POST['visible'];
                $product = $this->model('ProductModel');
                $product->toggleCheckboxDelete($id, $visible);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //multipleDeleteProduct()
    function multipleDeleteProduct()
    {
        try {
            if (isset($_POST['delete-multiple-data'])) {
                $product = $this->model('ProductModel');
                $result = $product->multipleDeleteProduct();
                if ($result) {
                    $_SESSION['success'] = 'Your products are deleted';
                    header('Location:Product');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:Product');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
