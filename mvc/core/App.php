<?php
namespace Core;
class App
{

    //Http://localhost/controller/action/param1/param2
    protected $controller = "Home"; // Default Controller
    protected $action = "display";  // Default Action(Medthod)
    protected $params = [];

    function __construct()
    {
        $arr = $this->UrlProcess();

        // Nếu URL là rỗng , gán URL là '/'
        if(empty($arr)){
            $arr=['/'];
        }

        //lấy URL từ mảng
        $uri=implode('/',$arr);

        //Gọi phương thức dispatch của route  để điều hướng
        Route::dispatch($uri);
    }

    function UrlProcess()
    {
        if (isset($_GET["url"])) {
            return explode('/', filter_var(trim($_GET["url"],'/')));
        }
        return [];
    }
}

