<?php

namespace Mvc\Controllers;

use Core\Controller;
use Core\Exception;

class Admin extends Controller
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
