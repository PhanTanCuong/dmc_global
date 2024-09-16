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

    public function addNavBarInfor($name, $slug,$status)
    {
        try {
            // Get the current maximum display_order value
            $query = "SELECT IFNULL(MAX(display_order), 0) + 1 as new_display_order FROM navbar";
            $result = $this->connection->query($query);
            $row = $result->fetch_assoc();
            $new_display_order = $row['new_display_order'];

            // Insert the new navbar item with the calculated display_order
            $stmt = $this->connection->prepare("INSERT INTO navbar (name, slug,status, display_order) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $name, $slug,$status, $new_display_order);
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

    public function fetchNavbarSelectedItems($id){
        try{
            $stmt=$this->connection->prepare(
                "SELECT 
                            selected_items.id AS slug,
                            selected_items.name
                            FROM navbar,
                                JSON_TABLE(
                                    child_items,
                                    '$[*]' COLUMNS(
                                        id VARCHAR(255) PATH '$.id',
                                        name VARCHAR(255) PATH '$.name'
                                    )
                                ) AS selected_items
                            WHERE navbar.id =?");
            $stmt->bind_param("i",$id)                        ;
            $stmt->execute();
            return $stmt->get_result();
        }catch(mysqli_sql_exception $e){    
            echo "Error: ". $e->getMessage();
        }
    }

    public function getAvailableItems($category_id,$data_id){
        try{
            $query="SELECT * FROM category WHERE parent_id=?";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("i",$category_id);
            $stmt->execute();

            $category=$stmt->get_result();

            $selected_items=$this->fetchNavbarSelectedItems($data_id);

            $selectedArray=[];

            while($selectedRows=mysqli_fetch_assoc($selected_items)){
                $selectedArray[]=$selectedRows['slug'];
            }

            $availableItems=[];

            while($availableRows=mysqli_fetch_assoc($category)){
                if(!in_array($availableRows['slug'],$selectedArray)){
                    $availableItems[]=[
                        'name'=>$availableRows['name'],
                        'slug'=>$availableRows['slug']
                    ];
                }
            }

            return $availableItems;
        }catch(mysqli_sql_exception $e){
            echo "Error: ".$e->getMessage();
        }
    }
}
