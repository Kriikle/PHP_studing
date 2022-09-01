<?php

interface IRate {
    public function resultPrize(): void;
    public function addService(IService $service): string;
}
