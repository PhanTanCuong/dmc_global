<?php
namespace Mvc\Model;

use \Core\DB;

class LayoutModel extends DB
{
    public function getLayout()
    {
        try {
            $query = "SELECT * FROM block";
            return $this->connection->query($query);
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addLayout($name)
    {
        try {
            $query = "INSERT INTO block (name) VALUES (?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $name);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {

        }
    }

    public function addPagelayout($page_id, $layout_id)
    {
        try {
            //set list order value
            $query = "SELECT COUNT(*) AS count FROM page_layouts WHERE page_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $page_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $list_order = $row['count'] + 1;

            $query = "INSERT INTO page_layouts (page_id,layout_id,list_order) VALUES (?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("iii", $page_id, $layout_id, $list_order);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>