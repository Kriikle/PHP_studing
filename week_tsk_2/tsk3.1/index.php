<?php

include('src/functions.php');

$peoplePut = generatePeople(50);
file_put_contents('users.json',json_encode($peoplePut,JSON_UNESCAPED_UNICODE));//Битовая маска в конце(кодировка)
$peopleGet = (json_decode(file_get_contents('users.json')));
//echo '<pre>';
//print_r($peopleGet);
//echo '</pre>';
//$age = $peopleGet[0]->{'age'};//0 - номер обекта(зачем если есть id),age индификатор
$sitisticPeople = countPeopleStisticks($peopleGet);
echo '<pre>';
print_r($sitisticPeople);
echo '</pre>';

