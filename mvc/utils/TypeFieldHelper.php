<?php
declare(strict_types=1);
namespace Mvc\Utils;

use Mvc\Utils\ImageHelper as ImageHelper;

class TypeFieldHelper
{
    public static function setFieldType(string $key)
    {
        try {
            // $key = (new self())->getStringFromBracket($key);
            $types = ['title', 'description', 'subtitle', 'image', 'link', 'button'];

            if (in_array($key, $types)) {
                    return $key;
            }

            return null;

        } catch (\Exception $e) {
            throw new \Exception("Error setting field type: " . $e->getMessage());
        }
    }

    public function getStringFromBracket($string)
    {
        try {
            preg_match('/\[(.*?)\]/', $string, $matches);
            return isset($matches[1]) ? trim($matches[1]) : null;
        } catch (\Exception $e) {
            throw new \Exception("Error getStringFromBracket: " . $e->getMessage());
        }
    }

    public static function gettringBeforeBracket(string $string){
        try{
            $pos = strpos($string,'[');

            if($pos === false){
                return $string;
            }

            return trim(substr($string,0,$pos));
        }catch(\Exception $e){
            throw new \Exception("Error gettringBeforeBracket: ". $e->getMessage());
        }

    }

    public static function trim(string $value)
    {
        try {
            if (!empty($value) && is_string($value)) {
                return trim($value);
            }




        } catch (\Exception $e) {
            throw new \Exception("Error trim: " . $e->getMessage());
        }
    }
}
?>