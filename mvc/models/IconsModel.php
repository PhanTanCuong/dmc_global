<?php

use Core\DB;

class IconsModel extends DB
{
    public function getInforIcons($id)
    {
        try {
            $query = "SELECT * FROM icon
                        WHERE block_id = '$id'
                        AND image <> 'footer.png'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addIconsImages($image)
    {
        try {
            $query = "INSERT INTO icon (block_id,image) VALUES (?,?)";
            $stmt = $this->connection->prepare($query);
            $id = 7;
            $stmt->bind_param("is", $id, $image);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getIconsById($id)
    {
        try {
            $query = "SELECT * FROM icon WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforIcons($id, $image)
    {
        try {
            $query = "UPDATE icon SET image=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $image, $id);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
        public function deleteIcons($id)
    {
        try {
            $query = "DELETE FROM icon WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
