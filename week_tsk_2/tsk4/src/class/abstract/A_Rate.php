<?php


/*
This class complements rate abstract class
*/
//А точно стоит делать его абстрактным?
abstract class A_Rate implements IRate
{
    //Дистанция и время с начала дейсвия улуги
    protected int $distance = 0;//Км
    protected float $time = 0;//Минуты

    //Свойства тарифа
    protected string $title = "";
    protected int $perDistance = 0;
    protected int $perTime = 0;

    //Результат
    protected float $prize;

    function __construct($distance, $time){
        $this->distance =  $distance;
        $this->time = $time;
    }

    abstract public function addService($service);//Here adding service

    //without service
    //only hourly not like this
    public function resultPrize()
    {
        $sum = $this->distance * $this->perDistance;
        $sum += $this->time * $this->perTime;
        $this->prize = $sum;
    }

    #one minute
    public function addTick()
    {
        $this->distance += 1;//60km/h / 60
        $this->time += 1;
    }

    public function getRateName(): string
    {

        return $this->title;
    }

    public function getDistance(): int
    {

        return $this->distance;
    }

    public function getTime(): float
    {

        return $this->time;
    }

    public function getPrize(): float
    {

        return $this->prize;
    }
}


