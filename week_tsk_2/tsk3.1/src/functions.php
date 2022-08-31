<?php

//
function generateUserList(int $numberOfUsers = 50): array
{
	$names = [
		'Карл',
		'Андрей',
		'Костя',
		'Алексей',
		'Иван',
		'Петр',
		'Максим',
		'Аня',
		'Маша',
		'Саша',
		'Даша',
		'Надя'
	];
    $users = [];

	for($i = 0; $i < $numberOfUsers; $i++) {
		$users[] = [
            'id' => $i,
            'name' => $names[array_rand($names)],
            'age' => rand(18, 45),
        ];
	}
	
	return $users;
}



//Get\Put Functions to json file
function saveUserListToJsonFile(string $fileName,array $users): void
{
    file_put_contents($fileName,json_encode($users,JSON_UNESCAPED_UNICODE));
    //Битовая маска в конце(кодировка)
}

function getUserListFromJsonFile(string $fileName): array
{

    return json_decode(file_get_contents($fileName),true);
}



//Statistics functions
function usersMeanAgeCount(array $users): float
{
    $age = 0;
    $meanAge = 0;

    foreach($users as $user) {
        $age += $user['age'];
    }

    if ($age) {
        $meanAge = $age / count($users);
    }

    return $meanAge;
}

function userUniqueNamesCount(array $users): array
{
    $namesCount = [];
    foreach($users as $user) {
        if (isset($namesCount[$user['name']])) {
            $namesCount[$user['name']]++;
        } else {
            $namesCount[$user['name']] = 1;
        }
    }

    return $namesCount;
}


/* Old
function countPeopleStisticks(array $users): array
{
	$age = 0;
	$namesCount = [];
	$counter = 0;

	foreach($users as $user) {
		if (isset($namesCount[$user['name']])) {
			$namesCount[$user['name']]++;
		}

		else {
			$namesCount[$user['name']] = 1;
		}
		$age += $user['age'];
		$counter++;
	}
	
	return ['meanAge' => $age / $counter,'namesCount' =>$ namesCount];
}
*/
