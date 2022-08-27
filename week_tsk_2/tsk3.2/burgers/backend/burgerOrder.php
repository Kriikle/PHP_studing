<?php

function isGetSet(string $nameGet)
    {
        if (isset($_GET[$nameGet])) {

            return $_GET[$nameGet];
        }
        return 0;
    }

    //Some flags
$callBackFlag = 0;
$payMethodFlag = 0;

    //Переменные
$userName = isGetSet('name');
$userPhone = isGetSet('phone');
$userMail = isGetSet('email');

$orderStreet = isGetSet('street');
$orderHouse = isGetSet('home');
$orderPart = isGetSet('part');
$orderAppt = isGetSet('Appt');
$orderFloor = isGetSet('floor');
$orderComment = isGetSet('Comment');

    //CallbackFlag installation
$callBackFlag = isGetSet('callback');
if ($callBackFlag === 'on') {
    $callBackFlag = 1;
}



if (!$callBackFlag) {
    //TODO validate phone here
    if ($userPhone === "" || $userPhone === 0) {
        echo 'Номер телефона неверно указан <br>';
    }
}



//TODO validate email here
if ($userMail === "" || $userMail === 0) {
    echo 'Email неверно указан <br>';
}

//
//TODO validate address here
if ($orderStreet === "" || $orderStreet === 0 || $orderHouse  === ""  || $orderHouse === 0 ) {
    echo 'Адрес неверно указан <br>';
}

echo $userPhone,$userMail;

//echo "Успешный заказ";



