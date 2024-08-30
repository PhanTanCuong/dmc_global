<?php

use Core\DB;

class CustomizeModel extends DB
{
    public function getAbout2Infor()
    {
        try {

            $this->connection->query("SET @row_number := 0");
            $query = "SELECT
                                data.block_id,
                                MAX(CASE WHEN row_num = 1 THEN image END) AS parent_image,
                                MAX(CASE WHEN row_num = 2 THEN image END) AS child_image,
                                data.title,
                                data.description
                                
                            FROM (
                                SELECT 
                                    image,
                                    block_id,
                                    (@row_number := @row_number + 1) AS row_num
                                FROM 
                                    background
                                WHERE 
                                    block_id = 3
                                ORDER BY 
                                    id
                            ) AS numbered_images
                            JOIN data ON numbered_images.block_id = data.block_id
                            WHERE data.block_id = 3
                            GROUP BY data.title, data.description";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAbout3Infor()
    {
        try {
            $query = "SELECT DISTINCT 
                            background.image, 
                            data.title, 
                            data.description 
                        FROM 
                            background 
                        JOIN 
                            data 
                            ON background.block_id = data.block_id 
                        WHERE 
                            background.block_id = 4;
";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getProduct1Infor()
    {
        try {
            $query = "SELECT 
                            background.image, 
                            data.title, 
                            data.description 
                        FROM 
                            background 
                        JOIN 
                            data 
                            ON background.block_id = data.block_id 
                        WHERE 
                            background.block_id = 5;
";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatIconInfor()
    {
        try {
            $query = "SELECT  
                            icon.image,
                            MAX(data.title) AS title,
                            MAX(data.description) AS description
                        FROM 
                            block
                        JOIN 
                            icon ON block.block_id = icon.block_id
                        JOIN 
                            data ON block.block_id = data.block_id
                        WHERE 
                            block.block_id = 6
                        GROUP BY 
                            icon.image;

";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

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

    public function getProductCategory()
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
            $query = "SELECT * FROM navbar ORDER BY navbar_id ASC";
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
}
