<?php
class  WorkerFacade
{
    private Developer $developer;
    private Designer $designer;

    public function __construct(Developer $developer, Designer $designer)
    {
        $this->developer = $developer;
        $this->designer = $designer;
    }

    public function startWork(): void
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork(): void
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}


class Developer
{
    public function startDevelop(): void
    {
        echo "start developing \n";
    }

    public function stopDevelop(): void
    {
        echo "stop developing \n";
    }
}

class Designer
{
    public function startDesign(): void
    {
        echo "start design \n";
    }

    public function stopDesign(): void
    {
        echo "stop design  \n";
    }
}

$designer = new Designer();
$developer = new Developer();

$workers = new WorkerFacade($developer, $designer);

$workers->stopWork();

