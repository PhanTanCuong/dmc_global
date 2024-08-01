<?php

namespace Core;

class Controller
{

    //model() function
    public function model($model)
    {
        require_once "./mvc/models/" . $model . ".php";
        return new $model;
    }

    //view() function

    public function view($view, $data = [])
    {
        require_once "./mvc/views/" . $view . ".php";
    }
}
