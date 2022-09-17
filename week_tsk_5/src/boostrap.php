<?php

//include_once('../vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;

define('FC_ADMIN',2);

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"localhost",
    "database" => "blog",
    "username" => "root",
    "password" => "root"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
