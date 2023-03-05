<?php

abstract class Expression
{
    abstract public function interpret(Context $context): bool;
}

class Context
{
    private array $worker = [];


    public function setWorker(string $worker): void
    {
        $this->worker[] = $worker;
    }

    public function lookUp($key): string|bool
    {
        if (isset($this->worker[$key])){
            return $this->worker[$key];
        }
        return false;
    }
}

class VariableExp extends Expression
{
    private int $key;

    public function __construct(int $key)
    {
        $this->key = $key;
    }


    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;

    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) && $context->lookUp($this->keyTwo);
    }
}

class OrExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;

    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne) || $context->lookUp($this->keyTwo);
    }
}

$context = new Context();

$context->setWorker('Ioann');
$context->setWorker('Alex');

$case1 = new VariableExp(1);
var_dump($case1->interpret($context));
$case2 = new AndExp(1, 3);
var_dump($case2->interpret($context));
$case3 = new OrExp(1, 3);
var_dump($case3->interpret($context));