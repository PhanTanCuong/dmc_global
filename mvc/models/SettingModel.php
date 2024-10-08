<?php
use Core\DB;


class SettingModel extends DB
{

    //Tab Head

    public function getHeadInfor()
    {
        try {
            $query = "SELECT DISTINCT 
                            icon.image, 
                            footer.title 
                        FROM 
                            icon 
                        JOIN 
                            footer 
                            ON icon.block_id = footer.block_id 
                        WHERE 
                            icon.block_id = 1;
";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeHeaderInfor($name, $image)
    {
        try {
            $query = "UPDATE icon 
                        JOIN footer ON icon.block_id = footer.block_id  
                        SET footer.title = ?, icon.image = ? 
                        WHERE icon.block_id = 1
            ";
            $stmt=$this->connection->prepare($query);
            return $stmt->execute([$name,$image]);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function getFooterIconInfor()
    {
        try {
            $query = "SELECT image 
                        FROM icon 
                        WHERE block_id = 7 
                        AND image LIKE '%ic%'";

          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

   

    public function getNavBarItem()
    {
        try {
            $query = "SELECT * FROM navbar ORDER BY display_order ASC";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function getMenuFooter()
    {

        try {
            $query="SELECT * FROM navbar";
            $result=$this->connection->query($query);

            //Menu items array
            $menu_items= [];

            while($row=$result->fetch_assoc()){
                // Check if the root navbar item has children  
                if(!empty($row['child_items'])){
                    $row['child_items']=json_decode($row['child_items'],true);
                }else{
                    $row['child_items']=[];
                }

                $menu_items[]=$row;
            }

            return $menu_items; //return  menu items's associative array
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getBackgroundbyId($id)
    {
        try {
            $query = "SELECT * FROM background WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function customizeBackgroundbyId($id, $image)
    {
        try {
            $query = "UPDATE background SET image='$image' WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function getIconbyId($id)
    {
        try {
            $query = "SELECT * FROM icon WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeIconbyId($id, $image)
    {
        try {
            $query = "UPDATE icon SET image='$image' WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function getDatabyId($id)
    {
        try {
            $query = "SELECT * FROM footer WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDataFooter()
    {
        try {
            $query = "SELECT * FROM footer WHERE block_id=7";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function editData($id, $title, $description)
    {
        try {
            $query = "UPDATE footer SET title='$title', description='$description' WHERE id='$id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLayoutbyId($block_id, $page_id)
    {
        try {
            $query = "SELECT * FROM item WHERE block_id='$block_id' AND product_category_id='$page_id'";
          return $this->connection->query($query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function fetchJsonCategory($id)
    {
        try {
            $query = "SELECT json_data FROM footer WHERE id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return json_decode($row['json_data'], true);
            } else {
                return null;
            }

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function fetchSelectedItem($id)
    {
        try {
            $stmt=$this->connection->prepare("SELECT 
                        selected_items.id AS slug,
                        selected_items.name
                    FROM footer,
                        JSON_TABLE(
                            json_data,
                            '$[*]' COLUMNS (
                                id VARCHAR(255) PATH '$.id',
                                name VARCHAR(255) PATH '$.name'
                            )
                        ) AS selected_items
                    WHERE footer.id =?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            return $stmt->get_result();

            // return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAvailableItems($category_id, $data_id) {
        try {
            // Lấy dữ liệu từ bảng category
            $query = "SELECT * FROM category WHERE level = 1 AND parent_id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $category_id);  
            $stmt->execute();
            $category = $stmt->get_result();  
    
            // Lấy selected items từ JSON
            $selecteditems = $this->fetchSelectedItem($data_id);
            // Khởi tạo mảng selectedItems
            $selectedArray = [];
    
            // Đưa các 'slug' từ selected_items vào mảng $selectedArray
            while ($selectedRow = mysqli_fetch_assoc($selecteditems)) {
                $selectedArray[] = $selectedRow['slug'];
            }
    
            // Khởi tạo mảng availableItems
            $availableItems = [];
    
            // Kiểm tra các phần tử từ category có trùng với selected_items không
            while ($categoryRow = mysqli_fetch_assoc($category)) {
                if (!in_array($categoryRow['slug'], $selectedArray)) {
                    // Đưa vào mảng availableItems nếu không trùng
                    $availableItems[] = [
                        'name' => $categoryRow['name'],
                        'slug' => $categoryRow['slug']
                    ];
                }
            }
    
            return $availableItems;
    
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getAvailableQuickLink($data_id){
        try{
            $query="SELECT * FROM navbar";
            $quick_link=$this->connection->query($query);

            $selecteditems=$this->fetchSelectedItem($data_id);
            
            $selectedArray=[];

            while($selectedRow=mysqli_fetch_assoc($selecteditems)){
                $selectedArray[]=$selectedRow['slug'];
            }

            $availableItems=[];

            while($quickLinkRow=mysqli_fetch_assoc($quick_link)){
                if(!in_array($quickLinkRow['slug'],$selectedArray)){
                    $availableItems[]=[
                        'name'=>$quickLinkRow['name'],
                        'slug'=>$quickLinkRow['slug']
                    ];
                }
            }

            return $availableItems;
        }catch(mysqli_sql_exception $e) {
            echo "Error:".$e->getMessage();
        }
    }

}
