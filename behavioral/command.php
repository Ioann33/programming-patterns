<?php

interface Command
{
    public function execute();
}

interface Undoable extends Command
{
    public function undo();
}

class Output
{
    private bool $isEnable = true;

    private string $body = '';

    public function enable(): void
    {
        $this->isEnable = true;
    }

    public function disable(): void
    {
        $this->isEnable = false;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    public function write($str): void
    {
        if ($this->isEnable){
            $this->body = $str;
        }
    }
}

class Invoker
{
    private Command $command;

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }

    public function run(): void
    {
        $this->command->execute();
    }
}

class Message implements Command
{
    private Output $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->output->write('some string from execute');
    }
}

class ChangerStatus implements Undoable
{

    private Output $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->output->enable();
    }

    public function undo()
    {
        $this->output->disable();
    }
}

$output = new Output();

$invoker = new Invoker();
$changeStatus = new ChangerStatus($output);
$changeStatus->undo();
$message = new Message($output);

$message->execute();

var_dump($output->getBody());