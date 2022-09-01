<?php

class Gps implements IService
{
    private string $info = 'Услуга "Gps в салон" активна';
    private int $id = 2;

    public function getServiceInfo(): string
    {

        return $this->info;
    }

    public function addServicePrize(?float $time): int
    {
        // 15*100 копеек в час, минимум 1 час. Округление в большую сторону
        $sum = ($time % 60) > 0 ? 1 : 0;
        $sum = $sum * 15;
        $sum += intdiv($time,60) * 15;
        return $sum * 100;
    }

    /**
     * @return int
     */
    public function getId(): int
    {

        return $this->id;
    }
}