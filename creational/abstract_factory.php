<?php

interface Worker
{
    public function work();
}

interface AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker;
    public static function makeDesignerWorker(): DesignerWorker;
}


interface DeveloperWorker extends Worker
{

}

interface DesignerWorker extends Worker
{

}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        echo "i am developing as native \n";
    }
}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        echo "i am developing as outsource \n";
    }
}


class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        echo "i am designing as native \n";
    }
}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {
        echo "i am designing as outsource \n";
    }
}


class OutsourceWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }
}

class NativeWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }
}

$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();
$nativeDeveloper->work();
$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();
$outsourceDeveloper->work();
$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();
$nativeDesigner->work();
$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();
$outsourceDesigner->work();