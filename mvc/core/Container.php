<?php
declare(strict_types=1);
namespace Mvc\Core;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;


class Container implements ContainerInterface
{
    public function get(string $id){

    }

    public function has(string $id): bool{}
}

?>