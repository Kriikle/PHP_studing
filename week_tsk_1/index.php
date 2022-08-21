<style>
    table, th, td {
        border: 1px solid;
    }
</style>
<?php

require('src/functions.php');

echo taskOne(['ok','life','uno']);
echo "<br>";
echo taskOne(['ok','life','uno'],true);
echo "<br>";

echo taskTwo('*',0-1,3.2,4,5.1);
echo "<br>";
echo taskTwo('/',0-1,3.2,4,5.1);
echo "<br>";
echo taskTwo('+',0-1,3.2,4,5.1);
echo "<br>";
echo taskTwo('-',0-1,3.2,4,5.1);
echo "<br>";

echo taskTree(10,5);
echo "<br>";
echo taskTree(0,-1);
echo "<br>";
echo taskTree(4,4);
echo "<br>";


echo taskFour();
echo "<br>";
echo taskFour(true);
echo "<br>";

echo taskFive();
echo "<br>";

echo taskSix('Test.txt');
echo "<br>";
