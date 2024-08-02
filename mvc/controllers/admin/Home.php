<?php

namespace Mvc\Controllers\Admin;

use Core\Controller;
use Core\Exception;

class Home extends Controller
{
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
