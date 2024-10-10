<?php
require_once "../mvc/core/App.php";
require_once "../mvc/core/Controller.php";
require_once "../mvc/core/DB.php";
require_once "../mvc/core/Route.php";
require_once "../mvc/core/Auth.php";
require_once "../mvc/routes/routes.php";

// autoload.php @generated  by Composer
require_once __DIR__ . '/../vendor/autoload.php';
// $id = new  \Ramsey\Uuid\UuidFactory();

// echo $id->uuid4();

// environment variables
\Dotenv\Dotenv::createImmutable(__DIR__."/.."."/")->load();

