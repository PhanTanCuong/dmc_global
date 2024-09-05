<?php

use Core\DB;

class CategoryModel extends DB
{
    //Product Category
    public function getInforCategory()
    {
        try {
            $query = "SELECT *
                        FROM product_category
                        ORDER BY 
                            CASE 
                                WHEN parent_id = 0 THEN id
                                ELSE parent_id
                            END,
                            parent_id, 
                            id";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getInforProductCategory()
    {
        try {
            $query = "SELECT * FROM product_category WHERE level=1 AND parent_id=23";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addCategoryInfor($name, $slug, $parent_id, $level)
    {
        try {
            $query = "INSERT INTO product_category (type,slug,parent_id,level) VALUES (?,?,?,?)";
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

    public function getCategoryById($id)
    {
        try {
            $query = "SELECT * FROM product_category WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforCategory($id, $name, $slug, $parent_id, $level)
    {
        try {
            $query = "UPDATE product_category SET type=?,slug=?,parent_id=?,level=? WHERE id = ?";
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
            $query = "DELETE FROM product_category WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function traceParent(int $category_id, int $level = 0)
    {
        //Find a atribute with id=parent_id
        $query = "SELECT * FROM product_category WHERE id = $category_id LIMIT 1";
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
            $query = "SELECT COUNT(*) AS child_count FROM product_category WHERE parent_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['child_count'] > 0; // Trả về true nếu có con
        }catch(mysqli_sql_exception $error) {
            echo "Error: ". $error->getMessage();
        }

    }
}

?>