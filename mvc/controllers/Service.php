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
            $slug=SlugHelper::getSlugFromURL();
            $menuModel = $this->model('MenuModel');
            $categoryModel = $this->model('CategoryModel');
            $paginayionService = new PaginationService($menuModel, $categoryModel);
            $service_data=$paginayionService->fetchPaginationRows($slug,0,1);
            $total_page=$paginayionService->getTotalPage($slug,12); 
            $this->view('home', [
                'service' => $service_data,
                'total_page' => $total_page,
                'page' => 'services',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>