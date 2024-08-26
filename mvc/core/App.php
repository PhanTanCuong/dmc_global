<?php
namespace Core;
class App
{

    //Http://localhost/controller/action/param1/param2
    protected $controller = "Product"; // Default Controller
    protected $action = "display";  // Default Action(Medthod)
    protected $params = [1];


    function __construct()
    {
        $arr = $this->UrlProcess();
        // Nếu URL là rỗng , gán URL là '/'
        if (empty($arr)) {
            $arr = ['/'];
        }

        //lấy URL từ mảng
        $uri = implode('/', $arr);

        //Gọi phương thức dispatch của route  để điều hướng
        Route::dispatch($uri);
    }

    //Phương thức xử lý URL: UrlProcess() hoặc parserUrl()
    public function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode('/', filter_var(rtrim($_GET["url"], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}

