<?php
namespace Mvc\Services;
use Mvc\Model\PageModel;
use Mvc\Model\CategoryModel;
use Core\DB;

class CategoryService extends DB
{

    public function __construct(
        protected PageModel $menuModel,
        protected CategoryModel $categoryModel
    ) {
        parent::__construct();
    }


    //Hàm ánh xạ bảng category đến bẳng product/post
    public function preferenceCategoryId($category_id)
    {
        try {
            $subCategory = $this->categoryModel->getCategoryById($category_id);

            if (!$subCategory) {
                return json_encode(null);
            }

            $table_name = $subCategory['type'];
            $id = $subCategory['id'];

            $query = "SELECT title,description,slug,image FROM $table_name WHERE category_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                return json_encode(null);
            }

            $result = $stmt->get_result();
            // $result->fetch_all(MYSQLI_ASSOC);
            return json_encode($result->fetch_all(MYSQLI_ASSOC));
        } catch (\mysqli_sql_exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
    public function getSubCategoryData($slug)
    {
        try {
            // Lấy danh mục cha dựa trên slug
            $parent_category = $this->menuModel->directPage($slug);
            $parent_category = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $parent_id = $parent_category['id'];

            // $categoryModel = new CategoryModel();

            $subCategories = $this->categoryModel->getCategory($parent_id);

            $subCategoriesData = []; // giá trị cuối cùng

            foreach ($subCategories as $subCategory) {

                $items = json_decode($this->preferenceCategoryId($subCategory['id']), true);

                //Tạo mảng item của danh mục con sản phẩm/bài viết
                $itemData = [];
                foreach ($items as $item) {
                    $itemData[] = $item;
                }

                $subCategoriesData[] = [
                    'name' => $subCategory['name'], // Tên của danh mục con
                    'items' => $itemData // Các sản phẩm hoặc bài viết thuộc danh mục con
                ];
            }
            unset($subCategory);
            return json_encode($subCategoriesData);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDataByCategory($slug)
    {
        try {
            $category = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $preference_id = $category['id'];

            return $this->preferenceCategoryId($preference_id);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getProductCategory($slug)
    {
        try {
            $product = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $type_id = $product['type_id'];

            $category = $this->categoryModel->getCategoryById($type_id);
            return $category['slug'];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    //add category

    public function addCategory()
    {
        try {
            $name = $_POST['category_name'];
            $slug = $_POST['category_slug'];
            $parent_id = (int) $_POST['category_parent'];
            $type = $_POST['category_type'];
            $level = $this->categoryModel->traceParent($parent_id);
            $preference_id = $this->categoryModel->addCategoryInfor($name, $slug, $parent_id, $level, $type);
            if (is_numeric($preference_id)) {
                if (! $this->menuModel->addMenu($slug, 'category', $preference_id)) {
                    $_SESSION['status'] = 'Lỗi! Không lưu được trang';
                    header('Location:Category');
                    exit();
                }
                ;
                $_SESSION['success'] = 'Lưu dữ liệu thành công!';
                header('Location:Category');
            } else {
                $_SESSION['status'] = 'Lưu dữ liệu thất bại!';
                header('Location:Category');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    // edit Category

    public function editCategory()
    {
        try {
            $id = $_POST['edit_category_id'];
            $name = $_POST['edit_category_name'];
            $slug = $_POST['edit_category_slug'];
            $parent_id = (int) $_POST['edit_category_parent'];
            $type = $_POST['edit_category_type'];

            $level = $this->categoryModel->traceParent($parent_id);
            $success = $this->categoryModel->customizeInforCategory($id, $name, $slug, $parent_id, $level, $type);
            if ($success) {
                if ($this->menuModel->updateMenu($slug, 'category', $id)) {
                    $_SESSION['status'] = 'Lỗi! Không lưu được trang';
                    header('Location:Category');
                    exit();
                }
                $_SESSION['success'] = 'Lưu dữ liệu thành công!';
                header('Location:Category');
            } else {
                $_SESSION['status'] = 'Lưu dữ liệu thất bại!';
                header('Location:Category');
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    //delete category
    public function deleteCategory($id){
        try{
            $item = $this->categoryModel;
            if ($item->hasChildren($id)) {
                $_SESSION['status'] = 'Lỗi! Không thể xóa vì chứa danh mục con.';
                header('Location:Category');
                die();
            }
            $success = $item->deleteCategory($id);
            if ($success) {
                if($this->menuModel->deleteMenu($id)){
                    $_SESSION['status'] = 'Lỗi! Không thể xóa trang';
                    header('Location:Category');
                    exit();
                }
                $_SESSION['success'] = 'Xóa thành công!';
                header('Location:Category');
            } else {
                $_SESSION['status'] = 'Xóa thất bại';
                header('Location:Category');
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

}
?>