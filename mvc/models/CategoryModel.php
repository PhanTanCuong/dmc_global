<?php

use Core\DB;

class CategoryModel extends DB
{
    //Product Category
    public function getInforCategory()
    {
        try {
            $query = "SELECT * FROM category_tree";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getInforParentCategory()
    {
        try {
            $query = "SELECT id,name,level FROM category_tree WHERE level <2";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCategoryById($id)
    {
        try {
            $query = "SELECT * FROM category WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            return ($stmt->execute()) ? $stmt->get_result() : null;
        } catch (mysqli_sql_exception $e) {
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
        } catch (mysqli_sql_exception $e) {
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
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addCategoryInfor($name, $slug, $parent_id, $level)
    {
        try {
            $query = "INSERT INTO category (name,slug,parent_id,level) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssii", $name, $slug, $parent_id, $level);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeInforCategory($id, $name, $slug, $parent_id, $level)
    {
        try {
            $query = "UPDATE category SET name=?,slug=?,parent_id=?,level=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssiii", $name, $slug, $parent_id, $level, $id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function deleteCategory($id)
    {
        try {
            $query = "DELETE FROM category WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function traceParent(int $category_id, int $level = 0)
    {
        //Find a atribute with id=parent_id
        $query = "SELECT * FROM category WHERE id = $category_id LIMIT 1";
        $result = mysqli_query($this->connection, $query);
        $category = mysqli_fetch_assoc($result);

        //category not found
        if (!$category) {
            return false;
        }
        // parent_id=0==>reached the root==>return the current level
        if ($category['parent_id'] == 0) {
            return $level + 1;
        } else {
            // parent_id <> 0, continue trace the parent category
            return $this->traceParent($category['parent_id'], $level + 1);
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
        } catch (mysqli_sql_exception $error) {
            echo "Error: " . $error->getMessage();
        }

    }

    public function getParentCategories()
    {
        try {
            $query = "SELECT * FROM category WHERE parent_id=0";
            return mysqli_query($this->connection, $query);
        } catch (Exception $e) {
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
            $query = "SELECT * FROM category WHERE slug=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $row) {
                $category_id = $row['id'];
            }

            return $category_id;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>