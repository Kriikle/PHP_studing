<?php

include('connection.php');
include('functions.php');

$conn = OpenCon();


//Some flags
$callBackFlag = 0;
$payMethodFlag = 0;
//Переменные
//User table
$userName = isGetSet('name');
$userPhone = getPhoneNumber('phone');
$userMail = isGetSet('email');
//Order table
$orderStreet = isGetSet('street');
$orderHouse = isGetSet('home');
$orderPart = isGetSet('part');
$orderAppt = isGetSet('appt');
$orderFloor = isGetSet('floor');
$orderComment = isGetSet('Comment');
//CallbackFlag installation
$callBackFlag = isGetSet('callback');
$callBackFlag = $callBackFlag === 'on' ? 1 : 0;


if ($userPhone === 0 || !preg_match('/^[0-9]{11}+$/', $userPhone)) {
    trigger_error("Номер телефона неверно указан", E_USER_ERROR);
}

if ($userMail === 0 || !filter_var($userMail,FILTER_VALIDATE_EMAIL)) {
    trigger_error("Email неверно указан", E_USER_ERROR);
}

if ($orderStreet === 0 || $orderHouse === 0 || $orderFloor === 0 || $orderAppt === 0) {
    trigger_error("Адрес неверно указан", E_USER_ERROR);
}

$deliveryFullAddress = $orderStreet . " Дом: " . $orderHouse;
$deliveryFullAddress = ($orderPart !== 0) ?  $deliveryFullAddress. " Корпус: " .$orderPart : $deliveryFullAddress;
$deliveryFullAddress .= " Этаж: " . $orderFloor;
$deliveryFullAddress .= " Квартира: " . $orderAppt;

//var_dump($orderStreet,$orderHouse,$orderPart,$orderFloor);
//Sql commands
$userId = 0;
$userId = (mysqli_fetch_row( $conn->query("SELECT id_user FROM user WHERE Email like '$userMail'")));

if (!isset($userId[0])) {
    $conn->query(
        "INSERT INTO `user` (`id_user`, `Email`, `Phone`, `Name`)"
        . "VALUES (NULL, '$userMail', '$userPhone', '$userName');"
    );
    $userId = (mysqli_fetch_row( $conn->query("SELECT id_user FROM user WHERE Email like '$userMail'")));
}

$conn->query(
    "INSERT INTO `orders` (`id_order`, `Street`, `Home`, `Appt`, `Floor`, `Coment`, `Paymethod`, `id_user`,`part`) "
    ." VALUES (NULL, '$orderStreet', '$orderHouse', '$orderAppt', '$orderFloor', "
    ."'$orderComment', '$payMethodFlag', '$userId[0]','$orderPart')"
);
$idOrder = mysqli_fetch_row($conn->query("SELECT MAX(id_order) FROM `orders`;"));
$numOrders = mysqli_fetch_row($conn->query("SELECT COUNT(*) FROM `orders` WHERE id_user = $userId[0];"));

//var_dump($numOrders);

echo "Спасибо, ваш заказ будет доставлен по адресу: $deliveryFullAddress <br>" ;
echo "Номер вашего заказа: $idOrder[0] <br>";
echo  "Это ваш $numOrders[0]-й заказ!";
//http_redirect('index.html');
CloseCon($conn);


