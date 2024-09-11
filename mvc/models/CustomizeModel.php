<?php

use Core\DB;

class CustomizeModel extends DB
{
    
    //Tab Head

    public function getHeadInfor()
    {
        try {
            $query = "SELECT DISTINCT 
                            icon.image, 
                            data.title 
                        FROM 
                            icon 
                        JOIN 
                            data 
                            ON icon.block_id = data.block_id 
                        WHERE 
                            icon.block_id = 1;
";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeHeaderInfor($name, $image)
    {
        try {
            $query = "UPDATE icon 
                        JOIN data ON icon.block_id = data.block_id  
                        SET data.title = '$name', icon.image = '$image' 
                        WHERE icon.block_id = 1
";
            return mysqli_query($this->connection, $query);
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

            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCategory()
    {
        try {
            $query = "SELECT * FROM product_category";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getNavBarItem()
    {
        try {
            $query = "SELECT * FROM navbar ORDER BY display_order ASC";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function getMenuFooter()
    {

        try {
            $query = "SELECT * FROM navbar";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getIdDropdownMenu()
    {
        try {
            // Giả sử kết nối cơ sở dữ liệu đã được khởi tạo
            $sql = "SELECT DISTINCT navbar_id FROM child_navbar ;"; // Câu truy vấn để lấy khóa ngoại

            $result = $this->connection->query($sql); // Thực hiện câu truy vấn

            $ids = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ids[] = $row['navbar_id']; // Thêm từng khóa ngoại vào mảng
                }
            }

            return implode(',', $ids); // Trả về chuỗi chứa các giá trị khóa ngoại, ngăn cách bởi dấu phẩy

        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getChildNavbarbyId($id)
    {
        try {
            $query = "SELECT * FROM child_navbar WHERE navbar_id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function getBackgroundbyId($id)
    {
        try {
            $query = "SELECT * FROM background WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function customizeBackgroundbyId($id, $image)
    {
        try {
            $query = "UPDATE background SET image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function getIconbyId($id)
    {
        try {
            $query = "SELECT * FROM icon WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function customizeIconbyId($id, $image)
    {
        try {
            $query = "UPDATE icon SET image='$image' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }


    public function getDatabyId($id)
    {
        try {
            $query = "SELECT * FROM data WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getDataFooter()
    {
        try {
            $query = "SELECT * FROM data WHERE block_id=7";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function editData($id, $title, $description)
    {
        try {
            $query = "UPDATE data SET title='$title', description='$description' WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLayoutbyId($block_id,$page_id){
        try{
            $query="SELECT * FROM item WHERE block_id='$block_id' AND product_category_id='$page_id'";
            return mysqli_query($this->connection, $query);
        }catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    }

    public function fetchJsonCategory($id){
        try{
            $query="SELECT json_data FROM data WHERE id=?";
            $stmt =$this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($row=$result->fetch_assoc()){
                return json_decode($row['json_data'],true); 
            }else{
                return null;
            }

        }catch(mysqli_sql_exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function test(){
        $query ="SELECT * FROM data ";
        $json= array();
        $stmt =$this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row=$result->fetch_assoc()){
            array_push($json,$row);
        }
        return json_encode($json);
    }

    public function fetchSelectedItem($id){
        try{
            $query="SELECT 
                        selected_items.id AS slug,
                        selected_items.name
                    FROM data,
                        JSON_TABLE(
                            json_data,
                            '$[*]' COLUMNS (
                                id VARCHAR(255) PATH '$.id',
                                name VARCHAR(255) PATH '$.name'
                            )
                        ) AS selected_items
                    WHERE data.id = $id";
           return mysqli_query($this->connection,$query);
        }catch(mysqli_sql_exception $e){
            throw new Exception($e->getMessage());        }
    }
}
