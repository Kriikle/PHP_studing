<?php





class Student extends A_Rate
{
    protected string $title = "Студенческий";
    protected int $perDistance = 4;
    protected int $perTime = 1;



    public function addService(object $service): string
    {
        $this->prize += $service->addServicePrize($this->getTime());
        return $service->getServiceInfo();
    }
}