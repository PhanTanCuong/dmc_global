<?php

use Core\DB;

class DataModel extends DB
{
    public function getItem($block_id, $page_id)
    {
        try {
            $query = "SELECT * FROM item WHERE block_id='$block_id' AND product_category_id	='$page_id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addData($title, $description, $image, $block_id, $page_id)
    {
        try {

            $query = "INSERT INTO item (title, description, image, block_id, product_category_id) VALUES (?,?,?,?,?)";

            // Khởi tạo đối tượng prepare
            $stmt = $this->connection->prepare($query);

            $stmt->bind_param('sssii', $title, $description, $image, $block_id, $page_id);

            $result = $stmt->execute();

            $stmt->close();

            return $result;
        } catch (mysqli_sql_exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }

    public function editItem($id, $title, $description, $image)
    {
        try {
            $query = "UPDATE item SET title = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $title, $description, $image, $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (mysqli_sql_exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteItem($id)
    {
        try {
            $query = "DELETE FROM item WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }

    public function getItemById($id)
    {
        try {
            $query = "SELECT * FROM item WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getBlock()
    {
        try {
            $query = "SELECT * FROM block WHERE block_id<7";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
