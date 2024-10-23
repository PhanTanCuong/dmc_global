<?php
namespace Mvc\Services;
use Mvc\Utils\TypeFieldHelper;
class LayoutService
{
    public function __construct(protected \ContentModel $contentModel, protected \LayoutModel $layoutModel)
    {
    }

    public function addContent(array $array, int $layoutId, int $pageId)
    {
        foreach ($array as $container => $content) {
            foreach ($content as $index => $item) {
                
                if (isset($_FILES[$container]['name']) && $_FILES[$container]['name'][$index]['image'] !== '') {
                    $image = $_FILES[$container]['name'];
                    $this->addImageField((string) $image[$index]["image"], $layoutId, $container, $index);
                }
                
                foreach ($item as $type => $value) {
                    if ($value === "") {
                        continue;
                    }
                    //gán  data
                    $this->contentModel->addContent($layoutId, $type, $value, $container, $index);

                  
                }


            }

        }

        if (!$this->layoutModel->addPagelayout($pageId, $layoutId)) {
            return false;
        }

        return true;
    }




    public function addImageField(string $fileName, int $layoutId, string $container, int $item)
    {
        try {
            $image = $_ENV['PICTURE_URL'] . '/' . $fileName;
            $type = 'image';
            if (\Mvc\Utils\ImageHelper::isImageField($_FILES[(string) $container]) === false) {
                $_SESSION['status'] = 'Incorrect image type';
                header('Location:../Admin/layout');
                die();
            }

            $result = $this->contentModel->addContent($layoutId, $type, $image, $container, $item);

            $imageUpload = $_FILES[$container]["tmp_name"][$item];

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