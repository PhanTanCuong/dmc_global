<?php

namespace Mvc\Utils;

class SlugHelper
{
    public static function getSlugFromURL()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url_component = explode("/", $url);
        return end($url_component);
    }
}