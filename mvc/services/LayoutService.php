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
        foreach ($array as $key => $field) {

            //gán biến container
            $container = TypeFieldHelper::gettringBeforeBracket($key);
            if (isset($_FILES[$key]['name']) && $_FILES[$key]['name']['image'] !=='') {
                $image = $_FILES[$key]['name'];
                $this->addImageField((string)$image["image"], $layoutId, $container);
            }

            foreach ($field as $name => $value) {

              
                
                //Ktra có cùng loại không 
                $sanitizeType = preg_replace('/[^a-z]/', '', $name);
                $type = TypeFieldHelper::setFieldType($sanitizeType);

                if ($type == null) {
                    continue;
                }

                //gán  data
                $data = TypeFieldHelper::trim($value);

                if ($data !== null) {
                    $this->contentModel->addContent($layoutId, $type, $data, $container);
                }
            }

        }

        return true;
    }




    public function addImageField(string $fileName, int $layoutId, string $container)
    {
        try {
            $image = $_ENV['PICTURE_URL'] . '/' . $fileName;
            $type = 'image';
            if (\Mvc\Utils\ImageHelper::isImageFile($_FILES[(string)$container]) === false) {
                $_SESSION['status'] = 'Incorrect image type';
                header('Location:../Admin/layout');
                die();
            }

            $result = $this->contentModel->addContent($layoutId, $type, $image, $container);

            $imageUpload=$_FILES[$container]["tmp_name"];
            
            if ($result) {
                $filepath = dirname(__DIR__, 3) . "\public\images\\" . $fileName;
                move_uploaded_file(
                    $fileName,
                    $imageUpload['image']
                ) . '';
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>