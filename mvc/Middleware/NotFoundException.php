<?php
declare(strict_types=1);
namespace Mvc\Middleware;
use Psr\Container\NotFoundExceptionInterface;
class NotFoundException extends \Exception implements NotFoundExceptionInterface{
     
}
?>