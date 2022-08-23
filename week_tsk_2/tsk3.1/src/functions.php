<?php
function generatePeople(int $numOfPeople): array
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
	$people = [];
	for($i = 0; $i < $numOfPeople; $i++) {
		$person = [
			'id' => $i,
			'name' => $names[rand(0, count($names)-1)],
			'age' => rand(18, 45),
			];
		$people[] = $person;
	}
	
	return $people;
}

function countPeopleStisticks(array $people): array
{
	$age = 0;
	$namesCount = [];
	$counter = 0;
	foreach($people as $person) {
		if (array_key_exists($person->{'name'}, $namesCount)) {
			$namesCount[$person->{'name'}]++;
		}
		else {
			$namesCount[$person->{'name'}] = 1;
		}
		$age += $person->{'age'};
		$counter++;
	}
	
	return ['meanAge'=> $age/ $counter,'namesCount'=>$namesCount];
}

