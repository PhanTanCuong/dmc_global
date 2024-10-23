<?php
declare(strict_types=1);
namespace Mvc\Middleware;
use Psr\Container\NotFoundExceptionInterface;
class ContainerException extends \Exception implements NotFoundExceptionInterface{
     
}
?>