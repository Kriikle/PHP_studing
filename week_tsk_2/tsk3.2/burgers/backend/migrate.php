<?php

include('connection.php');
$conn = OpenCon();
$com = file_get_contents('burgers.sql');
$conn->multi_query($com);
$conn->close();
