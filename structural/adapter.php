<?php

interface NativeWorker
{
    public function countSalary() : int;
}

interface OutsourceWorker
{
    public function countSalaryByOurs($hours) : int;
}

class NativeDeveloper implements NativeWorker
{
    public function countSalary(): int
    {
        return 700 * 22;
    }
}

class OutsourceDeveloper implements OutsourceWorker
{

    public function countSalaryByOurs($hours): int
    {
        return $hours * 150;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{

    private OutsourceWorker $outsourceDeveloper;

    public function __construct(OutsourceWorker $outsourceDeveloper)
    {
        $this->outsourceDeveloper = $outsourceDeveloper;
    }

    public function countSalary(): int
    {
        return $this->outsourceDeveloper->countSalaryByOurs(20);
    }
}

$nativeDeveloperSalary = new NativeDeveloper();
$outsourceDeveloperSalary = new OutsourceDeveloper();
$outsourceDeveloperSalaryAdapter = new OutsourceWorkerAdapter($outsourceDeveloperSalary);

var_dump($nativeDeveloperSalary->countSalary());
var_dump($outsourceDeveloperSalaryAdapter->countSalary());