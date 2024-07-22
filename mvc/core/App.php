<?php
 class App{
    
    //Http://localhost/controller/action/param1/param2
    protected $controller="Home"; //Layout (Controller) mặc định nếu enduser gõ ngẫu nhiên
    protected $action="test";//Action mặc định nếu enduser gõ ngẫu nhiên

    protected $params=[];

    function __construct(){
       $arr=$this->UrlProcess();
       

       //Xu Ly Controller
       //ucfirst($arr[0]):'Make a string's first character uppercase
       if(file_exists("./mvc/controllers/". $arr[0].".php")){
            $this->controller=$arr[0]; //end user nhập đầu vao Controller gì thì vẫn qua trang chủ user
            unset($arr[0]);
        }

        require_once "./mvc/controllers/". $this->controller.".php";

        //Xử lý Action
        if(isset($arr[1])){   
            if( method_exists($this->controller,$arr[1]) ){
                $this->action=$arr[1];    
            }
            unset($arr[1]);

        }

        //Xử lý Params
        $this->params=$arr?array_values($arr) : [];


        //Hàm tạo ra biến có kiểu lớp là controller(...)
        call_user_func_array(  [$this->controller,$this->action], $this->params);

    }

    function UrlProcess(){
        
        if(isset($_GET["url"])){
            return explode('/', filter_var(trim($_GET["url"])));
        }
    }
 }
?>