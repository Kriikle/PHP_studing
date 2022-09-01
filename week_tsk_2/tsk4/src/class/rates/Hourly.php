<?php



class Hourly extends A_Rate
{
    protected string $title = "Почасовой";
    protected int $perDistance = 0;
    protected int $perTime = 200*100 ;//60 minutes * 100 копеек

    public function resultPrize(): void
    {
        $sum = ($this->time % 60) > 0 ? 1 : 0;
        $sum = $sum * $this->perTime;
        $sum += intdiv($this->time,60) * $this->perTime;
        $this->prize += $sum;
    }

    public function addService(IService $service): string
    {
        $this->prize += $service->addServicePrize($this->time);
        return $service->getServiceInfo();
    }
}