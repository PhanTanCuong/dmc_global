<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
class Service extends Controller
{

    function display()
    {
        try {
            // $post = $this->model('MenuModel');

            // $post_data = $post->directPage(SlugHelper::getSlugFromURL());

            $this->view('home', [
                // 'about' => $post_data,
                'page' => 'services',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>