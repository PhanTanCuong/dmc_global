<?php
declare(strict_types=1);
namespace Mvc\Utils;

use Mvc\Utils\ImageHelper as ImageHelper;

class TypeFieldHelper
{
    public static function setFieldType(string $key)
    {
        try {
           $types=['title','description','subtitle','image','link','button'];

           if(in_array($key,$types)){
             return $key;
           }

           return null;

        } catch (\Exception $e) {
            throw new \Exception("Error setting field type: " . $e->getMessage());
        }
    }

    public static function trim(string $value){
        try{
            if(! empty($value) && is_string($value)){
                return trim($value);
            }

            


        }catch(\Exception $e){
            throw new \Exception("Error trim: ".$e->getMessage());
        }
    }
}
?>