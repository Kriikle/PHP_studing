<?php




class Base extends A_Rate
{
    protected string $title = "Базовый";
    protected int $perDistance = 10;
    protected int $perTime = 3;


    public function addService(object $service): string
    {

        $this->prize += $service->addServicePrize($this->time);
        return $service->getServiceInfo();
    }
}