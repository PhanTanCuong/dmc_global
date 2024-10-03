<?php
namespace Mvc\Services;
use Exception;
use MenuModel;
use CategoryModel;
use Core\DB;

class PaginationService extends DB
{
    private $menuModel;
    private $categoryModel;
    public function __construct(MenuModel $menuModel, CategoryModel $categoryModel)
    {
        parent::__construct();
        $this->menuModel = $menuModel;
        $this->categoryModel = $categoryModel;
    }

    public function fetchPaginationRows($slug, $offset, $limit)
    {
        try {

            $parent_category = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $table_name = $parent_category['type'];
            $preference_id = $parent_category['id'];

            $query = "SELECT title,description,slug,image FROM $table_name WHERE type_id=? LIMIT ?,?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("iii", $preference_id, $offset, $limit);

            return ($stmt->execute()) ? $stmt->get_result() : false;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function fetchTotalRows($slug)
    {
        try {
            $parent_category = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $table_name = $parent_category['type'];
            $preference_id = $parent_category['id'];

            $query = "SELECT COUNT(*) AS total FROM $table_name WHERE category_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $preference_id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total'];
            }

            return 0;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

    public function getTotalPage($slug, $limit)
    {
        try {
            $totalRows = $this->fetchTotalRows($slug);
            return ceil($totalRows / $limit);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }

}
?>