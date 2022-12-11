<?php

interface Renderable
{
    public function render(): string;
}

class Mail implements Renderable
{
    private array $parts = [];

    public function render(): string
    {
        $result = '';
        foreach ($this->parts as $part){
            $result.=$part->render()."\n";
        }

        return $result;
    }

    public function addPart(Renderable $part): void
    {
        $this->parts[] = $part;
    }
}

abstract class Part
{
    private string $text;
    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class Header extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Body extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}


class Footer extends Part implements Renderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

$email = new Mail();
$email->addPart(new Header('Header'));
$email->addPart(new Body('Body'));
$email->addPart(new Footer('Footer'));
echo $email->render();