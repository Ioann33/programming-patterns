<?php

class Worker
{
    private string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public static function make($arg) : Worker
    {
        return new self($arg['name']);
    }
}

class WorkerMapper
{
    private WorkerStorageAdapter $workerStorageAdapter;

    public function __construct(WorkerStorageAdapter $adapter)
    {
        $this->workerStorageAdapter = $adapter;
    }

    public function findById($id) : string | Worker
    {
        $res = $this->workerStorageAdapter->find($id);
        if ($res === null){
            return "not found";
        }
        return $this->make($res);
    }

    private function make($arg) : Worker
    {
        return Worker::make($arg);
    }
}

class WorkerStorageAdapter
{
    private array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }
        return null;
    }
}




$data = [
    1 => [
        'name' => 'Ioann'
    ]
];

$workerStorageAdapter = new WorkerStorageAdapter($data);

$workerMapper = new WorkerMapper($workerStorageAdapter);

$worker = $workerMapper->findById(1);

var_dump($worker->getName());