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

}
?>