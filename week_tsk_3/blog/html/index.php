<?php

include '../vendor/autoload.php';
include '../src/config.php';

session_start([
    'cookie_lifetime' => 86400,
]);

$user = new \App\Model\User(321,123,342);
$user1 = new \App\Model\User(321,123,342);
$user1->save();
$user1->save();
echo '</br>';
$msg = new \App\Model\BlogPost(1,'lolKek','I am lol kek porter');
$msg->save();
$msg->setText('Loefiwjfioewrjfoiewfouewfnewoufn');
$msg->update();
echo '</br>';
echo $user->getLogin();
$user->setLogin(21);
$user->setId(2);
$user->update();
echo $user->getLogin();
