<?php

use Core\DB;

class NavBarModel extends DB
{
    public function getInforNavBar()
    {
        try {
            $query = "SELECT * FROM navbar ORDER BY display_order ASC";
            return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLinkList()
    {
        try {
            $query = "SELECT name,slug FROM category_tree WHERE level = 0";
            return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function addNavBarInfor($name, $slug, $status, $parent_id)
    {
        try {
            // Get the current maximum display_order value
            $query = "SELECT COUNT(*) AS count FROM navbar WHERE parent_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $parent_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $list_order = $row['count'] + 1;

            // Insert the new navbar item with the calculated display_order
            $stmt = $this->connection->prepare("INSERT INTO navbar (name, slug,status, display_order,parent_id) VALUES (?, ?, ?, ?,?)");
            $stmt->bind_param("sssii", $name, $slug, $status, $list_order, $parent_id);
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
            $query = "SELECT * FROM navbar WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforNavBar($id, $name, $status, $slug)
    {
        try {
            $query = "UPDATE navbar SET name=?, status=?, slug=? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $name, $status, $slug, $id);
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
            $query = "DELETE FROM navbar WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
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
            return ($stmt->execute()) ? true : false;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function findSlugNavbar($slug)
    {
        $sql = "SELECT COUNT(*) FROM menu WHERE slug = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('s', $slug);
        return $stmt->execute();
     
    }

    //Child NavBar
    // public function storedSelectedChildItems($selectedItems, $id)
    // {
    //     try {
    //         $selectedItems = json_encode($selectedItems);

    //         $query = "UPDATE navbar SET child_items=CAST(? AS JSON) WHERE id=?";

    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param("si", $selectedItems, $id);
    //         if (!$stmt->execute()) {
    //             return false;
    //         }
    //         return true;
    //     } catch (mysqli_sql_exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function fetchNavbarSelectedItems($id)
    // {
    //     try {
    //         $stmt = $this->connection->prepare(
    //             "SELECT 
    //                         selected_items.id AS slug,
    //                         selected_items.name
    //                         FROM navbar,
    //                             JSON_TABLE(
    //                                 child_items,
    //                                 '$[*]' COLUMNS(
    //                                     id VARCHAR(255) PATH '$.id',
    //                                     name VARCHAR(255) PATH '$.name'
    //                                 )
    //                             ) AS selected_items
    //                         WHERE navbar.id =?"
    //         );
    //         $stmt->bind_param("i", $id);
    //         $stmt->execute();
    //         return $stmt->get_result();
    //     } catch (mysqli_sql_exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function getAvailableItems($category_id, $data_id)
    // {
    //     try {
    //         $query = "SELECT * FROM category WHERE parent_id=?";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param("i", $category_id);
    //         $stmt->execute();

    //         $category = $stmt->get_result();

    //         $selected_items = $this->fetchNavbarSelectedItems($data_id);

    //         $selectedArray = [];

    //         while ($selectedRows = mysqli_fetch_assoc($selected_items)) {
    //             $selectedArray[] = $selectedRows['slug'];
    //         }

    //         $availableItems = [];

    //         while ($availableRows = mysqli_fetch_assoc($category)) {
    //             if (!in_array($availableRows['slug'], $selectedArray)) {
    //                 $availableItems[] = [
    //                     'name' => $availableRows['name'],
    //                     'slug' => $availableRows['slug']
    //                 ];
    //             }
    //         }

    //         return $availableItems;
    //     } catch (mysqli_sql_exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
}
