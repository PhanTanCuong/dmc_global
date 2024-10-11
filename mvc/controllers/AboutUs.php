<?php

namespace Mvc\Controllers;
use Core\Controller;
use Core\Exception;
use Mvc\Utils\SlugHelper;
class AboutUs extends Controller
{
    function display()
    {
        try {
            $post = $this->model("PageModel");

            $post_data = $post->directPage(SlugHelper::getSlugFromURL());

            $this->view("index", [
                'about' => $post_data,
                'page' => 'about',
            ]);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
?>