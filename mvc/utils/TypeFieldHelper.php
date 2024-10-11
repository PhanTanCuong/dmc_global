<?php
namespace Mvc\Utils;

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
}
?>