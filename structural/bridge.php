<?php

interface Formatter
{
    public function format($str): string;
}

class SimpleText implements Formatter
{
    public function format($str): string
    {
        return $str;
    }
}

class HTMLText implements Formatter
{
    public function format($str): string
    {
        return "<h1>$str</h1>";
    }
}

abstract class BridgeService
{
    public Formatter $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    abstract public function getFormatter($str): string;
}


class SimpleTextService extends BridgeService
{
    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}

class HTMLTextService extends BridgeService
{

    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}

$text = new SimpleText();
$html = new HTMLText();

$textReformat = new SimpleTextService($text);
var_dump($textReformat->getFormatter('Hello Ioann'));
$htmlReformat = new HTMLTextService($html);
var_dump($htmlReformat->getFormatter('Hello Ioann'));

