<?php

interface Worker
{
    public function work();
}

interface WorkerFactory
{
    public static function make();
}

class Developer implements Worker
{
    public function work()
    {
        echo 'im developing';
    }
}


class Designer implements Worker
{
    public function work()
    {
        echo 'im designing';
    }
}


class DeveloperFactory implements WorkerFactory
{
    public static function make(): Developer
    {
        return new Developer();
    }
}

class DesignerFactory implements WorkerFactory
{
    public static function make(): Designer
    {
        return new Designer();
    }
}

$developer = DeveloperFactory::make();
$developer->work();
echo "\n";
$designer = DesignerFactory::make();
$designer->work();
echo PHP_EOL;