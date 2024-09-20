<?php
use Core\DB;

class MenuModel extends DB
{
    public function addMenu($slug, $preference_id)
    {
        try {
            $query = "INSERT INTO menu (slug,preference_id) VALUES(?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $slug, $preference_id);
            return ($stmt->execute()) ? true : false;
        } catch (mysqli_sql_exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function deleteMenu($preference_id)
    {
        try {
            $query = "DELETE FROM menu WHERE preference_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $preference_id);
            return ($stmt->execute()) ? true : false;
        } catch (mysqli_sql_exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    // public function updateMenu($category_id, $preference_id)
    // {
    //     try {
    //         $query = "UPDATE menu SET category_id=? WHERE preference_id=?";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param("ii", $category_id, $preference_id);
    //         return ($stmt->execute()) ? true : false;
    //     } catch (mysqli_sql_exception $e) {
    //         echo "Error" . $e->getMessage();
    //     }
    // }

    public function getMenuBySlug($slug)
    {
        try {
            $query = "SELECT * FROM menu WHERE slug=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $slug);
            return ($stmt->execute()) ? $stmt->get_result():null;
        } catch (mysqli_sql_exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}

?>