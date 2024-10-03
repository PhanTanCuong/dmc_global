<?php

namespace Mvc\Utils;

class SlugHelper
{
    public static function getSlugFromURL()
    {
        // Lấy URL từ REQUEST_URI
        $url = $_SERVER['REQUEST_URI'];

        // Tách phần URL trước dấu ? để loại bỏ các tham số truy vấn
        $url = explode('?', $url)[0];

        // Tách các thành phần của URL theo dấu /
        $url_component = explode("/", $url);

        // Lấy phần cuối cùng của URL, là slug cần lấy
        return end($url_component);
    }


    public static function next($page, $total_page)
    {
        return ((int) $page < $total_page) ? $page + 1 : $total_page;
    }

    public static function previous($page)
    {
        if ($page <= 1) {
            return 1;
        }

        return +$page - 1;
    }
}