<?php

use Core\DB;

class CustomizeModel extends DB
{
    public function getAbout2Infor()
    {
        try {

            $this->connection->query("SET @row_number := 0");
            $query="SELECT
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

    public function getAbout3Infor(){
        try{
            $query="SELECT DISTINCT background.image,data.title,data.description FROM block JOIN background ON block.block_id=background.block_id JOIN data ON block.block_id=data.block_id WHERE background.block_id=4";
            return mysqli_query($this->connection, $query);
        }catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatIconInfor()
    {
        try {
            $query = "SELECT  
                            icon.image,
                            data.title,
                            data.description
                        FROM 
                            block
                        JOIN 
                            icon ON block.block_id = icon.block_id
                        JOIN 
                            data ON block.block_id = data.block_id
                        WHERE 
                            block.block_id = 6
                        GROUP BY(icon.image);x
";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}
