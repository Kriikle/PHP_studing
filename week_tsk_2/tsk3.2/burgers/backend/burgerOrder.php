<?php

include('connection.php');


$conn = OpenCon();


function isGetSet(string $nameGet)
{
        if (isset($_GET[$nameGet])) {
            if ($_GET[$nameGet] === "" ){

                return 0;
            }
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
$orderAppt = isGetSet('appt');
$orderFloor = isGetSet('floor');
$orderComment = isGetSet('Comment');

    //CallbackFlag installation
$callBackFlag = isGetSet('callback');
if ($callBackFlag === 'on') {
    $callBackFlag = 1;
}



if (!$callBackFlag) {
    //TODO validate phone here
    if ($userPhone === 0) {
        echo 'Номер телефона неверно указан <br>';
        exit();
    }
}



//TODO validate email here
if ($userMail === 0) {
    echo 'Email неверно указан <br>';
    exit();
}

//
//TODO validate address here
if ($orderStreet === 0 || $orderHouse === 0 || $orderFloor === 0 || $orderAppt === 0) {
    echo 'Адрес неверно указан <br>';
    exit();
}

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
$deliveryPoint = $orderStreet . " Дом: " . $orderHouse;
$deliveryPoint = ($orderPart !== 0) ?  $deliveryPoint. " Корпус: " .$orderPart : $deliveryPoint;
$deliveryPoint .= " Этаж: " . $orderFloor;
$deliveryPoint .= " Квартира: " . $orderAppt;
echo "Спасибо, ваш заказ будет доставлен по адресу: $deliveryPoint <br>" ;
echo "Номер вашего заказа: $idOrder[0] <br>";
echo  "Это ваш $numOrders[0]-й заказ!";
//http_redirect('index.html');
CloseCon($conn);


