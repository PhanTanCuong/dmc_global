<?php
namespace Mvc\Services;

class addPostService {
    public function __construct(
        protected \PostModel $mediaModel,
        protected \PageModel $pageModel,
        protected \NavbarModel $navbarModel,
        protected \CategoryModel $categoryModel
    ) {

    }

    public function fetchPage(string $slug)
    {
        $page = $this->pageModel->getMenuBySlug($slug);
        if ($page['type'] === 'post') {
            $data = $this->mediaModel->getNewsbyId((int) $page['preference_id']);

            return json_encode($data->fetch_assoc());
        }

        return json_encode([]);

    }

    public function deleteNavbar(string $slug)
    {
        try {

            if(!isset($slug) && $slug !=='')return false;
            $page = $this->pageModel->getMenuBySlug($slug);

            $preference_id =(int) $page['preference_id'];
            if ($page['type'] === 'post') {
                if(! $this->mediaModel->deleteNews($preference_id)){
                    return json_encode(['success' => false, 'message' => 'Lỗi! Xóa bài viết']);
                }
            }

            if(! $this->categoryModel->deleteCategory($slug)){
                return json_encode(['success'=>false,'message'=>'Lỗi! Xóa danh mục']);
            }
            
            if(! $this->pageModel->deleteMenu($preference_id)){
                return json_encode(['success'=>false,'message'=>'Lỗi! Xóa trang']);
            }
            
            if(! $this->navbarModel->deleteNavbar($slug))
            {
                return json_encode(['success' => false, 'message' => 'Xóa dữ liệu không thành công']);
            }

            return json_encode(['success' => true, 'message' => 'Xóa dữ liệu thành công']);
      
            

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>