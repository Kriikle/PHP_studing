<?php

require('src/functions.php');

//$UsersGeneratedPut = generateUserList(50);
$UsersGeneratedPut = generateUserList();
saveUserListToJsonFile('users.json',$UsersGeneratedPut);
$UsersGeneratedGet = getUserListFromJsonFile('users.json');

echo '<pre>';
print_r($UsersGeneratedGet);
echo '</pre>';


echo "Средний возраст: ", usersMeanAgeCount($UsersGeneratedGet);

echo '<pre>';
print_r(userUniqueNamesCount($UsersGeneratedGet));
echo '</pre>';

/* Old
$sitisticPeople = countPeopleStisticks($UsersGeneratedGet);
echo '<pre>';
print_r($sitisticPeople);
echo '</pre>';
*/
