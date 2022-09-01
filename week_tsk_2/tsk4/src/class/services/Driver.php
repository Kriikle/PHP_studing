<?php


class Driver implements IService
{
    private int $id = 1;
    private string $info = 'Услуга "Дополнительный водитель" активна';

    public function getServiceInfo(): string
    {

        return $this->info;
    }

    public function addServicePrize(?float $time): int
    {
        //100*100 копеек единоразово
        return 100*100;
    }

    /**
     * @return int
     */
    public function getId(): int
    {

        return $this->id;
    }
}