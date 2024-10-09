<?php
namespace Mvc\Services;
use Exception;
use MenuModel;
use CategoryModel;
use Core\DB;

class PaginationService extends DB
{
    public function __construct(
        protected MenuModel $menuModel,
        protected CategoryModel $categoryModel
    ) {
        parent::__construct();
    }

    public function fetchPaginationRows($slug, $page, $limit)
    {
        try {

            $parent_category = mysqli_fetch_assoc($this->menuModel->directPage($slug));
            $table_name = $parent_category['type'];
            $preference_id = $parent_category['id'];
            $check = (int) $parent_category['parent_id'];


            $offset = ($page - 1) * $limit;

            if ($check !== 0) {
                $query = "SELECT title,description,slug,image FROM $table_name WHERE type_id=? LIMIT ?,?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("iii", $preference_id, $offset, $limit);
            } else {
                $query = "SELECT title,description,slug,image FROM $table_name LIMIT ?,?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("ii", $offset, $limit);
            }

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
            $check = (int) $parent_category['parent_id'];  // Check if it has a parent category

            // Nếu là category con, tính số hàng với điều kiện 'type_id'
            if ($check !== 0) {
                $query = "SELECT COUNT(*) AS total FROM $table_name WHERE type_id=?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("i", $preference_id);
            }
            // Nếu là category chính, tính số hàng không có điều kiện type_id
            else {
                $query = "SELECT COUNT(*) AS total FROM $table_name";
                $stmt = $this->connection->prepare($query);
            }

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total'];  // Trả về tổng số hàng
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