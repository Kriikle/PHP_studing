<?php

include 'includes.php';

$user1 = new Hourly(1,3);
$user2 = new Hourly(1,60);
$user3 = new Hourly(1,61);

$user4 = new Base(1,61);

$user5 = new Student(1,61);
$user6 = new Student(10,41);

echo "Ваш тариф: {$user1->getRateName()}";

$user1->addTick();
echo " time: ",$user1->getTime()," distance: ",$user1->getDistance();

echo '<br>';
$user1->addTick();
echo " time: ",$user1->getTime()," distance: ",$user1->getDistance();

echo '<br>';
$user1->resultPrize();
echo "your prize(1): {$user1->getPrize()}";

echo '<br>';
echo "Ваш тариф: {$user2->getRateName()}";
echo '<br>';
$user2->resultPrize();
echo "your prize(2): {$user2->getPrize()}";

echo '<br>';
echo "Ваш тариф: {$user3->getRateName()}";
echo '<br>';
$user3->resultPrize();
echo "your prize(3): {$user3->getPrize()}";

echo '<br>';
echo "Ваш тариф: {$user4->getRateName()}";
echo '<br>';
$user4->resultPrize();
echo "your prize(4): {$user4->getPrize()}";

echo '<br>';
echo "Ваш тариф: {$user5->getRateName()}";
echo '<br>';
$user5->resultPrize();
echo "your prize(5): {$user5->getPrize()}";

echo '<br>';
echo "Ваш тариф: {$user6->getRateName()}";
echo '<br>';
$user6->resultPrize();
echo "your prize(6): {$user6->getPrize()}";
