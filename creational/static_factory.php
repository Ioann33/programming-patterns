<?php

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        echo "i am developing \n";
    }
}

class Designer implements Worker
{
    public function work()
    {
        echo "i am designing \n";
    }
}

class WorkerFactory
{
    public static function make($workerTitle): ?Worker
    {
        $ClassName = strtoupper($workerTitle);

        if (class_exists($ClassName)){
            return new $ClassName;
        }

        return null;
    }
}

$worker = WorkerFactory::make('developer');
$worker->work();

$worker2 = WorkerFactory::make('designer');
$worker2->work();