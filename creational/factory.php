<?php

class Worker
{
    private string $name;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Worker constructor
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

}

class WorkerFactory
{
    public static function make($name): Worker
    {
        return new Worker($name);
    }
}


$worker = WorkerFactory::make('Ioann');

var_dump($worker->getName());