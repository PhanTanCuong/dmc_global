<?php
namespace Mvc\Model;

use Core\DB;

class PageModel extends DB
{
    public function __construct()
    {
        parent::__construct(); //khởi tạo lớp cha
    }
    public function addMenu($slug, $type, $preference_id)
    {
        try {
            $query = "INSERT INTO menu (slug,type,preference_id) VALUES(?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssi", $slug, $type, $preference_id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteMenu($preference_id)
    {
        try {
            $query = "DELETE FROM menu WHERE preference_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $preference_id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    public function updateMenu($slug, $type, $preference_id)
    {
        try {
            $query ="UPDATE menu SET slug=?, type=? WHERE preference_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssi", $slug, $type, $preference_id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getMenuBySlug($slug)
    {
        try {
            $query = "SELECT type,preference_id FROM menu WHERE slug=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $slug);
            // dd($stmt->get_result()->fetch_assoc());
            return ($stmt->execute()) ? $stmt->get_result()->fetch_assoc() : null;
        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function directPage($slug)
    {
        try {
            $menu = $this->getMenuBySlug(slug: $slug);

            if ($menu) {
                $table_name = $menu['type'];
                $id = $menu['preference_id'];

                $query = "SELECT * FROM $table_name WHERE id=?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    return $stmt->get_result();
                }
            }

            return false;


        } catch (\mysqli_sql_exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}

?>