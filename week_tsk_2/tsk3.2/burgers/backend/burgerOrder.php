<?php

include('connection.php');
include('functions.php');

$conn = OpenCon();

$arr = [
    'name' => '',
    'email' => '',
    'street' => '',
    'home' => '',
    'part' => '',
    'appt' => '',
    'floor' => '',
    'Comment' => '',
    'callback' => ''
];
foreach ($arr as $name => $item) {
    $arr[$name] = isgetSet($name);
}
//Some flags
$isCallBackRequired = 0;
$isPayMethodChoice = 0;
//Переменные
//User table
$userName = $arr['name'];
$userPhone = getPhoneNumber('phone');
$userMail = $arr['email'];
//Order table
$orderStreet = $arr['street'];
$orderHouse = $arr['home'];
$orderPart = $arr['part'];
$orderAppt = $arr['appt'];
$orderFloor = $arr['floor'];
$orderComment = $arr['Comment'];
//CallbackFlag installation
$isCallBackRequired = $arr['callback'];
$isCallBackRequired = $isCallBackRequired === 'on' ? 1 : 0;


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
$userId = mysqli_fetch_row($conn->query(
    sprintf("SELECT id_user FROM user WHERE Email like '%s'", $userMail))
);

if (!isset($userId[0])) {
    $conn->query(sprintf(
        "INSERT INTO `user` (`Email`, `Phone`, `Name`) VALUES ('%s', '%s', '%s');",
        $userMail,
        $userPhone,
        $userName)
    );
    $userId = mysqli_fetch_row($conn->query(
        sprintf("SELECT id_user FROM user WHERE Email like '%s'", $userMail))
    );
}

$query = "INSERT INTO `orders` (`Street`, `Home`, `Appt`, `Floor`, `Coment`, `Paymethod`, `id_user`,`part`) ";
$query .= "VALUES ('%s', '%s', '%s', '%s', '%s' , '%s' , '%s', '%s')";
$conn->query(sprintf(
        $query,
        $orderStreet,
        $orderHouse,
        $orderAppt,
        $orderFloor,
        $orderComment,
        $isPayMethodChoice,
        $userId[0],
        $orderPart
    ));
$idOrder = mysqli_fetch_row($conn->query("SELECT MAX(id_order) FROM `orders`;"));
$numOrders = mysqli_fetch_row($conn->query("SELECT COUNT(*) FROM `orders` WHERE id_user = $userId[0];"));
//var_dump($numOrders);
echo "Спасибо, ваш заказ будет доставлен по адресу: $deliveryFullAddress <br>" ;
echo "Номер вашего заказа: $idOrder[0] <br>";
echo  "Это ваш $numOrders[0]-й заказ!";
CloseCon($conn);


