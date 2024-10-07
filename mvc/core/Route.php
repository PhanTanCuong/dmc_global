<?php
namespace Core;

class Route
{
    private static $routes = [];

    public static function add($method, $uri, $controller)
    {
        // Biến URI thành dạng regex để có thể bắt các tham số động
        $uri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $uri);
        $uri = "#^" . $uri . "$#";
        self::$routes[] = [
            'method' => strtoupper($method), // Xác định phương thức HTTP
            'uri' => $uri, 
            'controller' => $controller
        ];
    }

    public static function get($uri, $controller)
    {
        self::add('GET', $uri, $controller); //method GET
    }

    public static function post($uri, $controller)
    {
        self::add('POST', $uri, $controller); //method POST
    }

    public static function put($uri, $controller)
    {
        self::add('PUT', $uri, $controller); //method PUT
    }

    public static function delete($uri, $controller)
    {
        self::add('DELETE', $uri, $controller); //method DELETE
    }

    public static function dispatch($uri)
    {
        // Lấy phương thức HTTP hiện tại
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            // So khớp cả phương thức và URI
            if ($method === $route['method'] && preg_match($route['uri'], $uri, $matches)) {
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
        header("Location:" . $_ENV['BASE_URL'] . "/404");
        exit();
    }
}

?>