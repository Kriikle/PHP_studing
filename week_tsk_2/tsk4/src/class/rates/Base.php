<?php




class Base extends A_Rate
{
    protected string $title = "Базовый";
    protected int $perDistance = 10 * 100;
    protected int $perTime = 3 * 100;

    public function addService(IService $service): string
    {
        $this->prize += $service->addServicePrize($this->time);

        return $service->getServiceInfo();
    }
}