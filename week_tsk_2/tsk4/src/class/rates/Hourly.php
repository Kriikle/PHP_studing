<?php





class Hourly extends A_Rate
{
    protected string $title = "Почасовой";
    protected int $perDistance = 0;
    protected int $perTime = 200 ;//60 minutes

    public function resultPrize()
    {
        $sum = ($this->time % 60) > 0 ? 1 : 0;
        $sum = $sum * $this->perTime;
        $sum += intdiv($this->time,60) * $this->perTime;
        $this->prize = $sum;
    }

    public function addService($service)
    {
        // TODO: Implement addService() method.
    }
}