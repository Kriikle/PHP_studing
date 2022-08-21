<?php

require('src/functions.php');

echo taskOne(['ok','life','uno']);
echo taskOne(['ok','life','uno'],true);

echo taskTwo('*',0-1,3.2,4,5.1);
echo taskTwo('/',0-1,3.2,4,5.1);
echo taskTwo('+',0-1,3.2,4,5.1);
echo taskTwo('-',0-1,3.2,4,5.1);