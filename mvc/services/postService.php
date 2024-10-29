<?php
namespace Mvc\Services;

class postService
{
    public function __construct(
        protected \PostModel $postModel,
        protected \PageModel $pageModel,
        protected \NavbarModel $navbarModel,
        protected \CategoryModel $categoryModel
    ) {

    }

    public function fetchPage(string $slug)
    {
        $page = $this->pageModel->getMenuBySlug($slug);
        if ($page['type'] === 'post') {
            $data = $this->postModel->getNewsbyId((int) $page['preference_id']);

            return json_encode($data->fetch_assoc());
        }

        return json_encode([]);

    }


    //add Post
    public function addPost()
    {
        try {
            //Input fields
            $category_id = $_POST['category'];
            $title = $_POST['news_title'];
            $slug = $_POST['news_slug'];
            $short_description = $_POST['news_description'];
            $long_description = $_POST['news_long_description'];
            $meta_keyword = $_POST['news_meta_keyword'];
            $meta_description = $_POST['news_meta_description'];
            $image = $_FILES["news_image"]['name'];



            //Check if image is an image file
            if (\Mvc\Utils\ImageHelper::isImageFile($_FILES["news_image"]) === false) {
                return json_encode(['success' => false, 'message' => 'Lỗi! Sai định dạng hình ảnh!!!']);
            }


            //Model

            $preference_id = $this->postModel->addNews(
                $title,
                $short_description,
                $long_description,
                $slug,
                $image,
                $meta_description,
                $meta_keyword,
                $category_id,
            );

            if (is_numeric($preference_id) && $preference_id > 0) {

                //add to slug center
                $this->pageModel->addMenu($slug, 'post', $preference_id);

                //Upload image data vào folder upload
                move_uploaded_file(
                    $_FILES["news_image"]["tmp_name"],
                    "./public/images/" . $_FILES["news_image"]["name"]
                ) . '';
                $filepath = dirname(__DIR__, 3) . "\public\images\\" . $image;
                \Mvc\Utils\ImageHelper::resize_image($filepath, 389, 389);

                return json_encode(['success' => true, 'message' => 'Lưu bài viết thành công']);
            } else {
                return json_encode(['success' => false, 'message' => 'Lỗi không thể lưu bài viết']);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    //delete Post

    public function deleteNavbar(string $slug)
    {
        try {

            if (!isset($slug) && $slug !== '')
                return false;
            $page = $this->pageModel->getMenuBySlug($slug);

            $preference_id = (int) $page['preference_id'];
            if ($page['type'] === 'post') {
                if (!$this->postModel->deleteNews($preference_id)) {
                    return json_encode(['success' => false, 'message' => 'Lỗi! Xóa bài viết']);
                }
            }

            if (!$this->categoryModel->deleteCategory($slug)) {
                return json_encode(['success' => false, 'message' => 'Lỗi! Xóa danh mục']);
            }

            if (!$this->pageModel->deleteMenu($preference_id)) {
                return json_encode(['success' => false, 'message' => 'Lỗi! Xóa trang']);
            }

            if (!$this->navbarModel->deleteNavbar($slug)) {
                return json_encode(['success' => false, 'message' => 'Xóa dữ liệu không thành công']);
            }

            return json_encode(['success' => true, 'message' => 'Xóa dữ liệu thành công']);



        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>