<?php

class WorkerPoll
{
    private array $freeWorkers = [];
    private array $busyWorkers = [];

    /**
     * @return array
     */
    public function getFreeWorkers(): array
    {
        return $this->freeWorkers;
    }

    /**
     * @return array
     */
    public function getBusyWorkers(): array
    {
        return $this->busyWorkers;
    }

    public function getWorker(): Worker
    {
        if (count($this->freeWorkers) === 0){
            $worker = new Worker();
        }else{
            $worker = array_pop($this->freeWorkers);
        }

        $this->busyWorkers[spl_object_hash($worker)] = $worker;
        return $worker;
    }

    public function release(Worker $worker)
    {
         $key = spl_object_hash($worker);

         if (isset($this->busyWorkers[$key])){
             unset($this->busyWorkers[$key]);
             $this->freeWorkers[$key] = $worker;
         }

    }
}

class Worker
{
    public function work()
    {
        echo "I am working\n";
    }
}


$pool = new WorkerPoll();

$worker = $pool->getWorker();
$worker2 = $pool->getWorker();
$worker3 = $pool->getWorker();

$worker->work();
$pool->release($worker);

var_dump($pool->getBusyWorkers());
var_dump($pool->getFreeWorkers());