<?php

include '../vendor/autoload.php';
include '../src/config.php';



$user = new \App\Model\User(321,123,342);
$user1 = new \App\Model\User(321,123,342);
//$user1->save();

echo $user->getLogin();
$user->setLogin(21);
$user->setId(2);
$user->update();
echo $user->getLogin();
