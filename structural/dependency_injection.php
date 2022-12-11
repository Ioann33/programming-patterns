<?php

class ControllerConfiguration
{
    private string $name;
    private string $action;

    public function __construct(string $name,string $action)
    {
        $this->name = $name;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}

class Controller
{
    private ControllerConfiguration $configuration;

    public function __construct(ControllerConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfig():string
    {
        return $this->configuration->getName().'@'.$this->configuration->getAction();
    }
}

$configuration = new ControllerConfiguration('UserController', 'index');

$controller = new Controller($configuration);

echo $controller->getConfig().PHP_EOL;

