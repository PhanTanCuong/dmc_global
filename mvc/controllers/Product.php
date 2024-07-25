<?php
class Product extends Controller
{
    //Load list of products layout
    function displayProduct()
    {
        //Model
        $product = $this->model("ProductModel");

        //View
        $this->view("admin/home", [
            "product" => $product->getProduct(),
            "page" => "displayProduct"
        ]);
    }

    //display detail infor user account
    public function displayDetailProduct()
    {
        if (isset($_POST["display_product_infor_btn"])) {
            //Model
            $product = $this->model("ProductModel");

            //View
            $this->view("admin/home", [
                "product" => $product->getProductbyId($_POST['edit_product_id']),
                "page" => "editProduct"
            ]);
        }
    }


    //Add new product function
    function addProduct($title = null, $description = null, $link = null, $image = null)
    {
        //Model
        try {
            if (isset($_POST['addProductBtn'])) {
                $title = strip_tags($_POST['product_title']);
                $description = strip_tags($_POST['product_description']);
                $link = strip_tags($_POST['product_link']);
                $image = $_FILES["product_image"]['name'];
                // $_FILES["product_image"]['name']:gán giá trị cho biến.


                //Kiểm tra xem ảnh có tồn tại trong kho lưu trữ ko
                if (file_exists("./mvc/uploads/" . $_FILES["product_image"]["name"])) {
                    $image_store = $_FILES["product_image"]["name"];
                    //$_FILES["product_image"]["name"]: truy cập trực tiếp vào phần tử name của mảng $_FILES["product_image"].
                    $_SESSION['status'] = "Image is already exists " . $image_store . "!";
                    header('Location:displayProduct');
                } else {
                    $product = $this->model("ProductModel");
                    $result = $product->addProduct($title, $description, $link, $image);
                    if ($result) {
                        //Upload image data vào folder upload
                        move_uploaded_file($_FILES["product_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["product_image"]["name"]) . '';
                        $_SESSION['success'] = "Product is added successfully";
                        header('Location:displayProduct');
                    } else {
                        $_SESSION['status'] = "Product is NOT added";
                        header('Location:displayProduct');
                    }
                }
            }
        } catch (Exception $e) {
            $_POST['status'] = $e->getMessage();
            header('Location:displayProduct');
        }
    }


    //Edit product function

    function editProduct()
    {
        try {

            if (isset($_POST["product_updatebtn"])) {
                $title = strip_tags($_POST['product_title']);
                $description = strip_tags($_POST['product_description']);
                $link = strip_tags($_POST['product_link']);
                $image = $_FILES["product_image"]['name'];
                $id = $_POST['edit_product_id'];
                $product = $this->model('ProductModel');
                $success = $product->editProduct($id, $title, $description, $link, $image);
                if ($success) {
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "./mvc/uploads/" . $_FILES["product_image"]["name"]) . '';
                    $_SESSION['success'] = 'Your data is updated';
                    header('Location: displayProduct');
                } else {
                    $_SESSION['status'] = 'Your data is NOT updated';
                    header('Location: displayProduct');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayProduct');
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
                    $_SESSION['success'] = 'Your data is deleted';
                    header('Location:displayProduct');
                } else {
                    $_SESSION['status'] = 'Your data is NOT deleted';
                    header('Location:displayProduct');
                }
            }
        } catch (Exception $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:displayProduct');
        }
    }


    //delete multiple products functions

    //toggleCheckbox()
    function toggleCheckboxDelete($id = null, $visible = null)
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
                    header('Location:displayProduct');
                } else {
                    $_SESSION['status'] = 'Your datas are NOT deleted';
                    header('Location:displayProduct');
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
