<?php
declare(strict_types=1);
namespace Core;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Mvc\Middleware\ContainerException;
use Mvc\Middleware\NotFoundException;


class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        //check if explicit binding
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            //return the callback function
            return $entry($this);
        }

        //if implicit binding
        $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {

        // 1. Inspect the class that we are trying to get from the container(using reflection api)
        $reflectionClass = new \ReflectionClass($id);

        //check if the class is instantiable(abstrct class or interface)
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException();
        }

        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        //check if the class has constructor 
        if (!$constructor) {
            return new $id;
        }

        // 3. Inspect the constructure parameters (dependencies)

        $parameters = $constructor->getParameters();

        //check if constructor has parameters
        if (!$parameters) {
            return new $id;
        }

        // 4. If the constructor parameter is the class then try to resolve that class using the container(recursive step)
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();


                //check if parameter is type hint
                if (!$type) {
                    throw new ContainerException(
                        'Failed to resolve class"' . $id . '" because param"' . $name . '" is missing a type hint'
                    );
                }

                //check if the parameter type can not instantiate(array,scalar,object)
                if($type instanceof \ReflectionUnionType){
                    throw new ContainerException(
                        'Failed to resolve class"' . $id . '" because of union type for param"' . $name . '" is missing a type hint'
                    ); 
                }

                if($type instanceof \ReflectionNamedType && ! $type->isBuiltin()){
                    return $this->get($type->getName());
                }
            },
            $parameters
        );

        return $reflectionClass->newInstanceArgs($dependencies); 
    }
}

?>