<?php
namespace Core;

class Route
{
    private static $routes = [];

    public static function add($uri, $controller)
    {
        // Biến URI thành dạng regex để có thể bắt các tham số động
        $uri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $uri);
        $uri = "#^" . $uri . "$#";
        self::$routes[] = ['uri' => $uri, 'controller' => $controller];
    }

    public static function dispatch($uri)
    {
        foreach (self::$routes as $route) {
            if (preg_match($route['uri'], $uri, $matches)) {
                // Lọc chỉ lấy các tham số từ URL
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                list($controller, $method) = explode('@', $route['controller']);

                if (strpos($uri, 'Admin/') === 0) {
                    $controllerClass = 'Mvc\\Controllers\\Admin\\' . $controller;
                } else {
                    $controllerClass = 'Mvc\\Controllers\\' . $controller;
                }

                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();

                    // Kiểm tra xem phương thức có tồn tại không, nếu có thì gọi nó với các tham số
                    if (method_exists($controllerInstance, $method)) {
                        // Gọi phương thức với các tham số, nếu không có tham số thì truyền mảng rỗng
                        call_user_func_array([$controllerInstance, $method], $params);
                    } else {
                        echo 'Method ' . $method . ' not found in controller ' . $controllerClass;
                    }
                    return;
                } else {
                    echo 'Controller class ' . $controllerClass . ' not found.';
                }
                return;
            }
        }

        // header('Location:dmc_global/public/views/404.php');
        echo '404 - Page not found';
    }
}
