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
                        return ['success' => false, 'message' => 'Định dạng ảnh không được hỗ trợ'];
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
                return ['success' => false, 'message' => 'File không tồn tại'];
            }
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function isImageFile($file)
    {
        $fileName = $file['tmp_name'];

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

    public static function moveUploadedFile($inputName)
    {

        //Kiểm tra file có tồn tại không
        if (!isset($_FILES[$inputName])) {
            return json_encode(['success' => false, 'message' => 'Lỗi! File ảnh không tồn tại']);
        }

        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/dmc_global/public/images';
        $tmp_name = $_FILES[$inputName]["tmp_name"];
        $upload_file = $uploads_dir . '/' . basename($_FILES["news_image"]["name"]);
        return move_uploaded_file($tmp_name, $upload_file);

    }

    // public static function isImageField($file){
    //     $total=count($file['tmp_name']);

    //     for($i=0;$i<$total;$i++){
    //         $fileName=$file['tmp_name'][$i]['image'];
    //         if($fileName===null){
    //             continue;
    //         }
    //         if (isset($file) && file_exists($fileName)) {
    //             $info = getimagesize($fileName);
    //             if ($info === false) {
    //                 return false;
    //             }

    //             $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    //             if (in_array($info['mime'], $validMimeTypes)) {
    //                 return true;
    //             }
    //         }

    //         return false;
    //     }

    //     return true;
    // }
}
