<?php

namespace Core;

class Controller
{

    //model() function
    public function model($model)
    {
        require_once "../mvc/models/" . $model . ".php";
        $class = "Mvc\\Model\\". $model;
        return new $class;
    }

    //view() function

    public function view($view, $data = [])
    {
        require_once "../public/views/" . $view . ".php";
    }
}
