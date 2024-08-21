<?php

namespace Mvc\Controllers;

use Core\Controller;

class Home extends Controller
{
    function display()
    {
        $this->view("home", [
            "page" => "displayAbout"
        ]);
    }
}
