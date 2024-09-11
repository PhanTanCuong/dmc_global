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
    public function storedSelectedChildItems($selectedItems,$id){
        try{
            $selectedItems=json_encode($selectedItems);
           
            $query="UPDATE navbar SET child_items=CAST(? AS JSON) WHERE id=?";
            
            $stmt =$this->connection->prepare($query);
            $stmt->bind_param("si",$selectedItems,$id);
            if(!$stmt->execute()){
                return false;
            }
            return true;
        }catch(mysqli_sql_exception $e){
            echo "Error: ". $e->getMessage();
        }
    }
}
