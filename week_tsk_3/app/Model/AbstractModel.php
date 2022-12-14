<?php

namespace App\Model;

Abstract class AbstractModel
{
    public static abstract function getAll();
    public abstract function getOne();
    public abstract function save();
    public abstract function update();

}