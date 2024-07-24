<?php
    class Product extends Controller {
        //Load list of products layout
        function displayProduct(){
            //Model
            $product=$this->model("ProductModel");
            
            //View
            $this->view("admin/home",[
                "product" => $product->getProduct(),
                "page"=>"displayProduct"
            ]);
        }
    //Add new product function
    function addProduct($title=null,$description=null,$link=null,$image=null){
        //Model
        // try{
            if(isset($_POST['addProductBtn'])){
                $title=$_POST['product_title'];
                $description=$_POST['product_description'];
                $link=$_POST['product_link'];
                $image=$_FILES['product_image'].['name'];
            

                //Kiểm tra xem ảnh có tồn tại trong kho lưu trữ ko
                if(file_exists("../uploads/".$_FILES['product_image']['name'])){
                   $image_store=$_FILES['product_image']['name'];
                   $_SESSION['status']="Image is already exists ".$image_store."!";
                   header('Location:displayProduct');
                }else{
                    $product=$this->model("ProductModel");
                    $result=$product->addProduct($title,$description,$link,$image);
                    if($result){
                        //Upload image data vào folder upload
                
                        if(move_uploaded_file($_FILES['product_image']['tmp_name'],"../uploads/".$_FILES['product_image']['name'])){
                            $_POST['status']="upload successful";
                            header('Location:displayProduct');
                        }else{
                            $_POST['status']="Error while uploading image";
                            header('Location:displayProduct');
                        }
                        $_POST['success']="Product is added successfully";
                        header('Location:displayProduct');
                    }else{
                        $_POST['status']="Product is NOT added";
                        header('Location:displayProduct');
                    }
                } 
            }

        // }catch(Exception $e){
        //     $_POST['status']=$e->getMessage();
        //     header('Location:displayProduct');
        // }
    }
}


    
?>