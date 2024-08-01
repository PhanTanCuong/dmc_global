<?php
    require_once "./mvc/core/App.php";
    require_once "./mvc/core/Controller.php";
    require_once "./mvc/core/DB.php";
    require_once "./mvc/core/Route.php";
    require_once "./mvc/routes/routes.php";

    require __DIR__ .'./public/vendor/autoload.php';

    $id= new  \Ramsey\Uuid\UuidFactory();

    echo $id->uuid4 () ;

?>