<?php

class Driver implements IService
{
    private string $info = 'Услуга "Дополнительный водитель" активна';

    public function addService(): string
    {

        return $this->info;
    }

    public function addServicePrize(float $time): int
    {
        //100 рублей единоразово
        return 100;
    }
}