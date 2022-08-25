<?php

include 'includes.php';

$user1 = new Student(1,3);
$user1->addTick();
echo " time: ",$user1->getTime()," distance: ",$user1->getDistance();

echo '<br>';
$user1->addTick();
echo " time: ",$user1->getTime()," distance: ",$user1->getDistance();
