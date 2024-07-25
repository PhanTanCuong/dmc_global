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
        try{
            if(isset($_POST['addProductBtn'])){
                $title=$_POST['product_title'];
                $description=$_POST['product_description'];
                $link=$_POST['product_link'];
                $image=$_FILES["product_image"]['name']; 
                // $_FILES["product_image"]['name']:gán giá trị cho biến.
             

                //Kiểm tra xem ảnh có tồn tại trong kho lưu trữ ko
                if(file_exists("./mvc/uploads/".$_FILES["product_image"]["name"])){
                   $image_store=$_FILES["product_image"]["name"];
                //$_FILES["product_image"]["name"]: truy cập trực tiếp vào phần tử name của mảng $_FILES["product_image"].
                   $_SESSION['status']="Image is already exists ".$image_store."!";
                   header('Location:displayProduct');
                }else{
                    $product=$this->model("ProductModel");
                    $result=$product->addProduct($title,$description,$link,$image);
                    if($result){
                        //Upload image data vào folder upload
                        move_uploaded_file($_FILES["product_image"]["tmp_name"],"./mvc/uploads/".$_FILES["product_image"]["name"]).'';
                        $_SESSION['success']="Product is added successfully";
                        header('Location:displayProduct');
                    }else{
                        $_SESSION['status']="Product is NOT added";
                        header('Location:displayProduct');
                    }
                } 
            }

        }catch(Exception $e){
            $_POST['status']=$e->getMessage();
            header('Location:displayProduct');
        }
    }
}


    
?>