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


    public function getSlugParent()
    {
        try {
            $query = "SELECT id,type FROM product_category";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addCategoryInfor($name, $slug, $parent_id)
    {
        try {
            $query = "INSERT INTO product_category (type,slug,parent_id) VALUES (?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssi", $name, $slug, $parent_id);
            $stmt->execute();
            return $stmt;
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
    public function customizeInforCategory($id, $name, $slug, $parent_id)
    {
        try {
            $query = "UPDATE product_category SET type=?,slug=?,parent_id=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssii", $name, $slug, $parent_id, $id);
            if (!$stmt->execute()) {
                return false;
            }
            ;

            return true;
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
}

?>