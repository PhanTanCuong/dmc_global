<?php

use Core\DB;

class NavBarModel extends DB
{
    public function getInforNavBar()
    {
        try {
            $query = "SELECT * FROM navbar ORDER BY display_order ASC";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addNavBarInfor($name, $status,$slug)
    {
        try {
            // Get the current maximum display_order value
            $query = "SELECT IFNULL(MAX(display_order), 0) + 1 as new_display_order FROM navbar";
            $result = $this->connection->query($query);
            $row = $result->fetch_assoc();
            $new_display_order = $row['new_display_order'];

            // Insert the new navbar item with the calculated display_order
            $stmt = $this->connection->prepare("INSERT INTO navbar (name, status,slug, display_order) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $name, $status,$slug, $new_display_order);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getNavBarById($id)
    {
        try {
            $query = "SELECT * FROM navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforNavBar($id, $name, $status,$slug)
    {
        try {
            $query = "UPDATE navbar SET name=?, status=?, slug=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $name, $status,$slug, $id);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteNavBar($id)
    {
        try {
            $query = "DELETE FROM navbar WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function sortNavbarItem($id, $display_order)
    {
        try {
            $query = "UPDATE navbar SET display_order=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ii", $display_order, $id);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    //Child NavBar
    public function getInforChildNavBar()
    {
        try {
            $query = "SELECT child_navbar.id,child_navbar.name AS child,navbar.name AS parent FROM child_navbar JOIN navbar ON child_navbar.navbar_id=navbar.id";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addChildNavBar($nav_parent_id, $name)
    {
        try {
            $query = "INSERT INTO child_navbar (navbar_id,name) VALUES (?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("is", $nav_parent_id, $name);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getChildNavBarById($id)
    {
        try {
            $query = "SELECT * FROM child_navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforChildNavBar($id, $name)
    {
        try {
            $query = "UPDATE child_navbar SET name=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $name, $id);
             if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteChildNavBar($id)
    {
        try {
            $query = "DELETE FROM child_navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
