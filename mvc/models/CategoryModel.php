<?php

namespace Mvc\Model;

use Core\DB;

class CategoryModel extends DB
{
    public function __construct()
    {
        parent::__construct();
    }
    //Product Category
    public function getInforCategory()
    {
        try {
            $query = "SELECT * FROM category_tree";
            return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
            // return $this->connection->query($query);
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getInforParentCategory(int $level)
    {
        try {
            $query = "SELECT id,name,level FROM category_tree WHERE level <?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $level);
            $stmt->execute();
            return $stmt->get_result();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCategoryByType(string $type)
    {
        try {
            $query = "SELECT id,name,slug FROM category_tree WHERE type=? AND level<2";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $type);
            $stmt->execute();
            // dd($stmt->get_result());
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    


    public function getCategoryById($id)
    {
        try {
            $query = "SELECT * FROM category WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCategory($parent_id)
    {
        try {
            $query = "SELECT * FROM category WHERE parent_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $parent_id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getProductCategory($parent_id)
    {
        try {
            $query = "SELECT * FROM category_tree WHERE order_sequence LIKE ? AND level>0";
            $stmt = $this->connection->prepare($query);
            $likePattern = "%$parent_id%";
            $stmt->bind_param("s", $likePattern);
            $stmt->execute();
            return $stmt->get_result();
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addCategoryInfor($name, $slug, $parent_id, $level, $type)
    {
        try {
            $query = "INSERT INTO category (name,slug,parent_id,level,type) VALUES (?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssiis", $name, $slug, $parent_id, $level, $type);
            return ($stmt->execute()) ? $this->connection->insert_id : false;
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeInforCategory($id, $name, $slug, $parent_id, $level, $type)
    {
        try {
            $query = "UPDATE category SET name=?,slug=?,parent_id=?,level=?,type=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssiisi", $name, $slug, $parent_id, $level, $type, $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteCategory($id)
    {
        try {
            $query = "DELETE FROM category WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteCategoryBySlug($slug)
    {
        try {
            $query = "DELETE FROM category WHERE slug=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('s', $slug);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function traceParent(int $category_id, int $level = 0)
    {
        //Find a atribute with id=parent_id
        $query = "SELECT * FROM category WHERE id = $category_id LIMIT 1";
        $result = $this->connection->query($query)->fetch_assoc();
        // dd($result);
        //category not found
        if (!$result) {
            return $level + 1;
        }
        // parent_id=0==>reached the root==>return the current level
        if ($result['parent_id'] == 0) {
            return $level + 1;
        } else {
            // parent_id <> 0, continue trace the parent category
            return $this->traceParent($result['parent_id'], $level + 1);
        }
    }

    public function hasChildren($category_id)
    {
        try {
            $query = "SELECT COUNT(*) AS child_count FROM category WHERE parent_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['child_count'] > 0; // Trả về true nếu có phần tử con
        } catch (\mysqli_sql_exception $error) {
            echo "Error: " . $error->getMessage();
        }

    }

    public function getParentCategories()
    {
        try {
            $query = "SELECT * FROM category WHERE parent_id=0";
            return $this->connection->query($query);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getChildCategoriesByParentId($parentCategoryId)
    {
        $query = "SELECT * FROM category WHERE parent_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $parentCategoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $childCategories = [];
        while ($row = $result->fetch_assoc()) {
            $childCategories[] = $row;
        }
        return $childCategories;
    }

    public function getCategoryIdBySlug($slug)
    {
        try {
            $query = "SELECT id FROM category WHERE slug = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $result = $stmt->get_result();

            // Kiểm tra kết quả trả về và lấy hàng đầu tiên
            if ($row = $result->fetch_assoc()) {
                return $row['id'];
            }

            // Trả về null nếu không tìm thấy
            return null;

        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

?>