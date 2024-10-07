<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Services\PaginationService;
use Mvc\Utils\SlugHelper;
class Service extends Controller
{

    function display()
    {
        try {
            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $slug = SlugHelper::getSlugFromURL();

            $paginayionService = new PaginationService($menuModel, $categoryModel);

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $service_data = $paginayionService->fetchPaginationRows($slug, (int) $page, 3);
            $total_page = $paginayionService->getTotalPage($slug, 3);

            $this->view('home', [
                'current_page'=>$page,
                'service' => $service_data,
                'total_page' => $total_page,
                'next_page' => SlugHelper::Next($page, $total_page),
                'previous_page' => SlugHelper::Previous($page),
                'page' => 'services',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>