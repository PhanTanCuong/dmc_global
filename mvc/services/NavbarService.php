<?php
namespace Mvc\Services;

use Mvc\Model\NavBarModel,
Mvc\Model\CategoryModel,
Mvc\Model\PageModel;
class NavbarService
{
    public function __construct(
        protected NavbarModel $navbarModel,
        protected CategoryModel $categoryModel,
        protected PageModel $pageModel
    ) {

    }

    public function addNavbar()
    {
        try {
            $name = $_POST['navbar_name'];
            $status = $_POST['navbar_status'];
            $slug = $_POST['navbar_link'];


            $success = $this->navbarModel->addNavBarInfor($name, $slug, $status, 0);

            if (!$success) {
                $_SESSION['status'] = 'Lỗi! Thêm dữ liệu.';
                header('Location:NavBar');
                exit();
            }

            $preference_id = $this->categoryModel->addCategoryInfor($name, $slug, 0, 1, 'category');
            if ($preference_id === false) {
                $_SESSION['status'] = 'Lỗi! Thêm danh mục.';
                header('Location:NavBar');
                exit();
            }
            $this->pageModel->addMenu($slug, 'category', $preference_id);

            $_SESSION['success'] = 'Thêm dữ liệu thành công';
            header('Location:NavBar');

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function editNavbar()
    {
        try {
            $id = $_POST['edit_navbar_id'];
            $name = $_POST['edit_navbar_name'];
            $status = $_POST['edit_navbar_status'];
            $slug = $_POST['edit_navbar_link'];
            $success = $this->navbarModel->customizeInforNavBar($id, $name, $status, $slug);
            if (!$success) {

                $_SESSION['status'] = 'Lỗi! Không thể cập nhật';
                header('Location:NavBar');
                exit();
            }

            if(!($this->categoryModel->customizeInforCategory($id, $name, $slug,0,1,'category'))){
                $_SESSION['status'] = 'Lỗi! Không thể cập nhật danh mục';
                header('Location:NavBar');
                exit();
            }

            if(!($this->pageModel->updateMenu($name, $slug,$id))){
                $_SESSION['status'] = 'Lỗi! Không thể cập nhật trang';
                header('Location:NavBar');
                exit();
            }
            
            $_SESSION['success'] = 'Cập nhật thành công';
            header('Location:NavBar');

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>