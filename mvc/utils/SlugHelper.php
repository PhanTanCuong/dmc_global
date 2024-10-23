<?php

namespace Mvc\Utils;
use mysqli_sql_exception;

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

        $slug = end($url_component);

        $isSlugValid = self::isSlugExists($slug);

        if (!$isSlugValid) {
            // abort(404); Laravel
            header("Location:" . $_ENV['BASE_URL'] . "/404");
            exit();
        }

        // Lấy phần cuối cùng của URL, là slug cần lấy
        return $slug;
    }




    protected static function isSlugExists($slug)
    {
        try {
            $menuModel = new \PageModel();

            $query = "SELECT COUNT(*) FROM menu WHERE slug=?";
            $stmt = $menuModel->connection->prepare($query);
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();

            return $count > 0;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
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