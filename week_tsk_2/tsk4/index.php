<?php

include 'includes.php';

//Услуги (singleton)
$driver = new Driver();
$gps = new Gps();

$user1 = new Hourly(1,60);
$user2 = new Hourly(1,60);
$user3 = new Hourly(1,61);

$user4 = new Base(5,60);//Из примера задания

$user5 = new Student(1,61);
$user6 = new Student(1,61);

echo "Ваш тариф: {$user1->getRateName()}";
echo '<br>';
echo " time: ",$user1->getTime()," distance: ",$user1->getDistance();
//$user1 output
echo '<br>';
$user1->resultPrize();
echo $user1->addService($driver);
echo '<br>';
echo $user1->addService($gps);
echo '<br>';
echo "your prize(1): {$user1->getPrize()}";
//$user2 output
echo '<br>';
echo '<br>';
echo "Ваш тариф: {$user2->getRateName()}";
echo '<br>';
$user2->resultPrize();
echo "your prize(2): {$user2->getPrize()}";
//$user3 output
echo '<br>';
echo '<br>';
echo "Ваш тариф: {$user3->getRateName()}";
echo '<br>';
$user3->resultPrize();
echo "your prize(3): {$user3->getPrize()}";
//$user4 output
echo '<br>';
echo '<br>';
echo "Ваш тариф: {$user4->getRateName()}";
echo '<br>';
echo $user4->addService($driver);
echo '<br>';
echo $user4->addService($gps);
echo '<br>';
$user4->resultPrize();
echo "your prize(4): {$user4->getPrize()}";
//$user5 output
echo '<br>';
echo '<br>';
echo "Ваш тариф: {$user5->getRateName()}";
echo '<br>';
$user5->resultPrize();
echo "your prize(5): {$user5->getPrize()}";
//$user6 output
echo '<br>';
echo '<br>';
echo "Ваш тариф: {$user6->getRateName()}";
echo '<br>';
echo $user6->addService($gps);
echo '<br>';
$user6->resultPrize();
echo "your prize(6): {$user6->getPrize()}";
echo '<br>';
echo "your prize(6): {$user6->getPrize()}";

