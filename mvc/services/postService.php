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
            $category_id = (int)$_POST['category'] ?? null;
            $title = (string)$_POST['news_title'] ?? '';
            $slug = (string)$_POST['news_slug'] ?? '';
            $short_description = (string)$_POST['news_description'] ?? '';
            $long_description = $_POST['news_long_description'] ?? '';
            $meta_keyword = (string)$_POST['news_meta_keyword'] ?? '';
            $meta_description = (string)$_POST['news_meta_description'] ?? '';
            $image = $_FILES["news_image"]['name'] ?? '';

            //Kiểm tra ảnh có được upload 
            if (isset($_FILES["news_image"]) && $_FILES["news_image"]["error"] === UPLOAD_ERR_OK) {
                // Kiểm tra định dạng ảnh
                if (\Mvc\Utils\ImageHelper::isImageFile($_FILES["news_image"]) === false) {
                    return json_encode(['success' => false, 'message' => 'Lỗi! Sai định dạng hình ảnh!!!']);
                }
            }

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

            if($category_id ===0 || $this->isMenuItem($category_id)){
                if(!($this->navbarModel->addNavBarInfor($title,$slug,'active',$category_id))){
                    return json_encode(['success'=>false,'message'=>'Lỗi! Không lưu được danh mục']);
                }
            }

            if (is_numeric($preference_id) && $preference_id > 0) {

                //add to slug center
                $this->pageModel->addMenu($slug, 'post', $preference_id);

                if (isset($_FILES["news_image"]) && $_FILES["news_image"]["error"] === UPLOAD_ERR_OK) {
                    if (\Mvc\Utils\ImageHelper::moveUploadedFile('news_image')) {
                        $filepath = dirname(__DIR__, 3) . "\dmc_global\public\images\\" . $image;
                        \Mvc\Utils\ImageHelper::resize_image($filepath, 389, 389);
                        return json_encode(['success' => true, 'message' => 'Lưu bài viết thành công']);
                    } else {
                        return json_encode(['success' => false, 'message' => 'Lỗi! Không thể lưu file ảnh']);
                    }
                }
    
                return json_encode(['success' => true, 'message' => 'Lưu bài viết thành công']);
            } else {
                return json_encode(['success' => false, 'message' => 'Lỗi ! không thể lưu bài viết']);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    //delete Post

    public function deletePost(string $slug)
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


    protected function isMenuItem(int $category_id){
        $category=$this->categoryModel->getCategoryById($category_id);
        return $this->navbarModel->findSlugNavbar($category['slug']);
    }
}
?>