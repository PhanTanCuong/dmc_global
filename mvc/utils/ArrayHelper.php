<?php
namespace Mvc\Utils;
class ArrayHelper{
    public static function prettyArray($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}
?>