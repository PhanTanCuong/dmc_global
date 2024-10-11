<?php
namespace Mvc\Utils;
class LayoutHelper{
    public static function getBlockIdAndcategoryId()
    {
        try {
            $block_id = 3;
            $product_category_id = 1;

            // Model
            if (isset($_GET['radio_option'])) {
                // Set new block_id and expire the old one
                setcookie("block_id", "", time() - 3600); // Expire old block_id cookie
                setcookie("block_id", $_GET['radio_option'], time() + 3600); // Set new block_id cookie
                $block_id = $_GET['radio_option'];
            } else {
                $block_id = isset($_COOKIE['block_id']) ? $_COOKIE['block_id'] : 3;
            }

            if (isset($_GET['product_category_id'])) {
                setcookie("product_category_id", "", time() - 3600);
                setcookie("product_category_id", $_GET['product_category_id'], time() + 3600);
                $product_category_id = $_GET['product_category_id'];
                $block_id = 3;
                setcookie("block_id", "", time() - 3600);
                setcookie("block_id", $block_id, time() + 3600);
            } else {
                $product_category_id = isset($_COOKIE['product_category_id']) ? $_COOKIE['product_category_id'] : 1;
            }

            return [
                "block_id"=>$block_id,
                "product_category_id"=>$product_category_id
            ];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getCategoryIdSlider(){
        try{
            if (isset($_GET['page'])) {
                setcookie("product_category_id", "", time() - 3600);
                setcookie("product_category_id", $_GET['page'], time() + 3600);
                $product_category_id = $_GET['page'];
            } else {
                $product_category_id = isset($_COOKIE['page']) ? $_COOKIE['page'] : 1;
            }

            return $product_category_id;
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
?>