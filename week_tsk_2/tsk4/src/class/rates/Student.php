<?php





class Student extends A_Rate
{
    protected string $title = "Студенческий";
    protected int $perDistance = 4 * 100;
    protected int $perTime = 100;//1*100 в копейках

    public function addService(IService $service): string
    {
        $this->prize += $service->addServicePrize($this->getTime());

        return $service->getServiceInfo();
    }
}