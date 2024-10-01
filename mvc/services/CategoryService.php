<?php
namespace Mvc\Services;
use MenuModel;
use CategoryModel;
use Core\DB;

class CategoryService extends DB
{
    private $menuModel;
    private $categoryModel;

    public function __construct(MenuModel $menuModel, CategoryModel $categoryModel)
    {
        $this->menuModel = $menuModel; //Dependency Injection design pattern
        $this->categoryModel = $categoryModel;
    }


    //Hàm ánh xạ bảng category đến bẳng product/post
    public function preferenceCategoryId($category_id)
    {
        try {
            $subCategory = $this->categoryModel->getCategoryById($category_id);

            if ($subCategory) {
                foreach ($subCategory as $field) {
                    $table_name = $field['type'];
                    $id = $field['preference_id'];
                }
                $query = "SELECT * FROM $table_name WHERE category_id=?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    return $result->fetch_assoc();
                }
            }

            return null;

        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getSubCategoryData($slug)
    {
        try {
            // Lấy danh mục cha dựa trên slug
            $parent_category = $this->menuModel->directPage($slug);
            foreach ($parent_category as $field) {
                $parent_id = $field['parent_id'];
            }

            unset($field);// Xóa biến để tránh xung đột

            $subCategories = $this->categoryModel->getCategory($parent_id);

            $subCategoriesData = []; // giá trị cuối cùng

            foreach ($subCategories as $subCategory) {

                $items = $this->preferenceCategoryId($subCategory['id']);

                //Tảo mảng item của danh mục con sản phẩm/bài viết
                $itemData = []; 
                if(is_array($items)) {
                    foreach($items as $item){
                        $itemData[] = $item;
                    }
                }
              
                $subCategoriesData[$subCategory['slug']] = [
                    'name' => $subCategory['name'], // Tên của danh mục con
                    'items' => $itemData // Các sản phẩm hoặc bài viết thuộc danh mục con
                ];
            }

            return $subCategoriesData;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
?>