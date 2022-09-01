<?php

interface IService {
    public function getServiceInfo(): string;
    public function addServicePrize(?float $time): int;
    public function getId(): int;
}