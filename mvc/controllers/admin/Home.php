<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Middleware;

class Home extends Controller
{

        public function __construct()
        {
            Middleware::checkAdmin();
        }
    function display()
    {
        //Model
        $total = $this->model("AccountModel");
        //View
        $this->view("admin/home", [
            "totalUser" => $total->totalUser(),
            "page" => "main"

        ]);
    }
}
