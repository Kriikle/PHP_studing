<?php

include '../vendor/autoload.php';
include '../src/config.php';

use App\Model\User;

session_start([
    'cookie_lifetime' => 86400,
]);

$user = new \App\Model\User('321@mail.ru',12,123,342);
$user1 = new \App\Model\User('13241@mail.ru',123,342,'bo');
$user1->save();
$user1->save();
$user->getAll();

echo '</br>';
$msg = new \App\Model\Message(2,'lolKek','I am lol kek porter');
//$msg->getAll();

$msg->save();
$msg->setText('Loefiwjfioewrjfoiewfouewfnewoufn');
$msg->update();
echo '</br>';
echo $user->getLogin();
$user->setLogin(21);
$user->setId(2);
$user->update();
echo $user->getLogin();
echo '</br>';
$user2 = User::getByEmail('13241@mail.ru');
var_dump($user2);
echo '</br>';
var_dump(User::getByEmail('132431@mail.ru'));

