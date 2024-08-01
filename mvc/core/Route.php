<?php
// Namespace giúp tổ chức mã nguồn và tránh xung đột tên, đặc biệt là trong các ứng dụng lớn với nhiều lớp và hàm.
namespace Core; 
class Route
{

    private static $routes = [];

    public static function showRoutes()
    {
        return self::$routes;
    }
    public static function add($uri, $controller)
    {
        $uri = "#^" . $uri . "$#";
        self::$routes[] = ['uri' => $uri, 'controller' => $controller];
    }

    public static function dispatch($uri)
    {
        foreach (self::$routes as $route) {
            // the preg_match() function returns whether a match was found in a string.
            if (preg_match($route['uri'], $uri, $matches)) {
                if (count($matches) > 0) {
                    list($controller, $method) = explode('@', $route['controller']);
                    $controllerClass = 'dmc_global\\mvc\\controllers\\' . $controller; //
                    $controllerInstance = new $controllerClass();
                    $controllerInstance->$method();
                    return;
                }
            }
        }
        echo '404 - Page not found';
    }
}
