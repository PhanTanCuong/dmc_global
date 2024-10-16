<?php

namespace Mvc\Utils;

class ImageHelper
{
    public static function resize_image($file, $newWidth, $newHeight)
    {
        try {
            if (file_exists($file)) {
                $info = getimagesize($file);
                $mime = $info['mime'];
                switch ($mime) {
                    case 'image/jpeg':
                        $original_image = imagecreatefromjpeg($file);
                        break;
                    case 'image/png':
                        $original_image = imagecreatefrompng($file);
                        break;
                    case 'image/gif':
                        $original_image = imagecreatefromgif($file);
                        break;
                    default:
                        throw new \Exception('Unsupported image format');
                }

                $original_width = imagesx($original_image);
                $original_height = imagesy($original_image);

                $newImage = imagecreatetruecolor($newWidth, $newHeight);

                imagecopyresampled(
                    $newImage,
                    $original_image,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $original_width,
                    $original_height
                );

                switch ($mime) {
                    case 'image/jpeg':
                        imagejpeg($newImage, $file, 90);
                        break;
                    case 'image/png':
                        imagepng($newImage, $file);
                        break;
                    case 'image/gif':
                        imagegif($newImage, $file);
                        break;
                }

                imagedestroy($original_image);
                imagedestroy($newImage);
            } else {
                throw new \Exception('File does not exist');
            }
        } catch (\Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }

    public static function isImageFile( $file)
    {
        $fileName= $file['tmp_name'];
        if(is_array($fileName)){
            $fileName=(string)$fileName['image'];
        }
        if (isset($file) && file_exists($fileName)) {
            $info = getimagesize($fileName);
            if ($info === false) {
                return false;
            }

            $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($info['mime'], $validMimeTypes)) {
                return true;
            }
        }

        return false;
    }
}
