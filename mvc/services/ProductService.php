<?php 
namespace Mvc\Services;

use Mvc\Model\CategoryModel;
use Mvc\Model\PageModel;
use Mvc\Model\ProductModel;
use Mvc\Utils\ImageHelper;

class ProductService {

    public function __construct(
        protected ProductModel $productModel,
        protected CategoryModel $categoryModel,
        protected PageModel $pageModel
    ) {

    }

    //add Product
    public function addProduct(){
        try{
              //Input fields
              $category_id = (int)$_POST['category'];
              $title = $_POST['product_title'];
              $slug = $_POST['product_slug'];
              $short_description = $_POST['product_description'];
              $long_description = $_POST['product_long_description'];
              $meta_keyword = $_POST['product_meta_keyword'];
              $meta_description = $_POST['product_meta_description'];
              $image = $_FILES["product_image"]['name'];

              //Check if image is an image file
              if (ImageHelper::isImageFile($_FILES["product_image"]) === false) {
                  $_SESSION['status'] = 'Lỗi! Sai định dạng hình ảnh!!!';
                  header('Location:../Product');
                  die();
              }
              $row=$this->categoryModel->getCategoryById($category_id);
              $type_id=$row['parent_id'];

              $preference_id = $this->productModel->addProduct(
                  $title,
                  $short_description,
                  $long_description,
                  $slug,
                  $image,
                  $meta_description,
                  $meta_keyword,
                  $category_id,
                  $type_id
              );
              if (is_numeric($preference_id) && $preference_id > 0) {

                  //add to slug center
                  if(! $this->pageModel->addMenu($slug, 'product', $preference_id)){
                    $_SESSION['status'] = "Lỗi! Thêm không được trang";
                    header('Location:../Product');
                  };

                  //Upload image data vào folder upload
                  move_uploaded_file(
                      $_FILES["product_image"]["tmp_name"],
                      "./public/images/" . $_FILES["product_image"]["name"]
                  ) . '';

                  $_SESSION['success'] = "Thêm thành công";
                  header('Location:../Product');
              } else {
                  $_SESSION['status'] = "Thêm thất bại";
                  header('Location:../Product');
              }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    //update product
    public function updateProduct(){
        try{
            $category_id = (int) $_POST['category'];
            $title = $_POST['edit_product_title'];
            $short_description = $_POST['edit_product_description'];
            $long_description = $_POST['edit_product_long_description'];
            $meta_keyword = $_POST['edit_product_meta_keyword'];
            $meta_description = $_POST['edit_product_meta_description'];
            $id = $_POST['edit_product_id'];

            $data = $this->productModel->getCurrentProductImages($id);
            $stored_image = mysqli_fetch_array($data);

            //Check image is null
            if (!empty($_FILES["product_image"]['name'])) {
                if (ImageHelper::isImageFile($_FILES["product_image"]) === false) {
                    $_SESSION['status'] = 'Incorrect image type';
                    header('Location:../Product');
                    die();
                }
                $image = $_FILES["product_image"]['name'];
            } else {
                $image = $stored_image['image'];
            }

            $row = $this->categoryModel->getCategoryById($category_id);
            $type_id = $row['parent_id'];

            $success = $this->productModel->editProduct(
                $id,
                $title,
                $short_description,
                $long_description,
                $image,
                $meta_keyword,
                $meta_description,
                $category_id,
                $type_id
            );
            if ($success) {

                // $this->pageModel->updateMenu($category_id,$id);

                move_uploaded_file(
                    $_FILES["product_image"]["tmp_name"],
                    "./public/images/" . $_FILES["product_image"]["name"]
                ) . '';

                $_SESSION['success'] = 'Your data is updated';
                header('Location:../Product');
            } else {
                $_SESSION['status'] = 'Your data is NOT updated';
                header('Location:../Product');
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    //delete product 
    public function deleteProduct($id){
        try{
            $result = $this->productModel->deleteProduct($id);
            if ($result) {
                if(! $this->pageModel->deleteMenu($id)){
                    $_SESSION['status'] = 'Lỗi! Không xóa trang thành công';
                };
                $_SESSION['success'] = 'Xóa thành công';
                header('Location:Product');
            } else {
                $_SESSION['status'] = 'Xóa thất bại';
                header('Location:Product');
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
?>