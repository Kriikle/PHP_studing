<?php


/*
This class complements rate abstract class
*/
abstract class A_Rate implements IRate
{
    protected int $distance = 0;//Км
    protected float $time = 0;//Минуты

     function __construct($distance, $time){
         $this->distance =  $distance;
         $this->time = $time;
     }

    abstract public function resultPrize();
    abstract public function addService($service);

    #one minute
    public function addTick()
    {
        $this->distance += 1;//60km/h / 60
        $this->time += 1;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function getTime(): float
    {
        return $this->time;
    }
}


