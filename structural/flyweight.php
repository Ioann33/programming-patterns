<?php
interface Mail
{
    public function render();
}

abstract class TypeMail
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getName() ."Business Mail \n";
    }
}

class JobMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getName() ."Job Mail \n";
    }
}

class MailFactory
{
    private array $pool;

    public function getMail(int $id,string $mailType): Mail
    {
        if (!isset($this->pool[$id])){
            return $this->make($mailType);
        }
        return $this->pool[$id];
    }

    private function make(string $mailType): Mail
    {
        if ($mailType === 'business'){
            return new BusinessMail('Business text');
        }
        return new JobMail('Job text');
    }
}


$mail = new MailFactory();
print_r($mail->getMail(1, 'business')->render());