<?php

class Gps implements IService
{
    private string $info = 'Услуга "Gps в салон" активна';

    public function addService(): string
    {

        return $this->info;
    }

    public function addServicePrize(float $time): int
    {
        // 15 рублей в час, минимум 1 час. Округление в большую сторону
        return round(($time/60)) * 15;
    }
}