<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Auth;

class Home extends Controller
{

        public function __construct()
        {
            Auth::checkAdmin();
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
