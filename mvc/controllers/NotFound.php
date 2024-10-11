<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
class NotFound extends Controller
{
    function display()
    {
        try {
            $post = $this->model("PageModel");

            $post_data = $post->directPage(SlugHelper::getSlugFromURL());

            $this->view("index", [
                'page' => '404',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>