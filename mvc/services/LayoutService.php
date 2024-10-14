<?php
namespace Mvc\Services;
use Mvc\Utils\TypeFieldHelper;
class LayoutService
{
    public function __construct(protected \ContentModel $contentModel)
    {

    }

    public function addContent(array $array, int $layoutId)
    {
        foreach ($_POST as $key => $field) {
            //Ktra có cùng loại không 
            $type = TypeFieldHelper::setFieldType($key);

            if ($type == null) {
                break;
            }

            //gán  data
            $data = TypeFieldHelper::trim($field);

            $this->contentModel->addContent($layoutId, $type, $data, 'content');
        }

        return true;
    }


    public function addImageField(string $fileName, int $layoutId)
    {
        try {
            $image = $_ENV['PICTURE_URL'] . '/' . $_FILES["image"]["name"];
            $type = 'image';
            if (\Mvc\Utils\ImageHelper::isImageFile($_FILES["image"]) === false) {
                $_SESSION['status'] = 'Incorrect image type';
                header('Location:../layout');
                die();
            }

            $result = $this->contentModel->addContent($layoutId, $type, $image, 'content');

            if ($result) {
                $filepath = dirname(__DIR__, 3) . "\public\images\\" . $fileName;
                move_uploaded_file(
                    $_FILES["image"]["tmp_name"],
                    $filepath
                ) . '';
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>