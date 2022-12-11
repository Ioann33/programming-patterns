<?php

abstract class Registry
{
    private static array $services = [];

    final public static function setService($key, Service $service): void
    {
        self::$services[$key] = $service;
    }

    final public static function getService($key): string|Service
    {
        if (isset(self::$services[$key])){
            return self::$services[$key];
        }
        return "This service doesn't exist";
    }

}

class Service
{

}

$service = new Service();

Registry::setService(1, $service);

$service = Registry::getService(1);
var_dump($service);