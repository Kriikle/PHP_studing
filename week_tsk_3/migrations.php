<?php

require_once 'src/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
$com = file_get_contents('sqlscripts/blog.sql');
$conn->multi_query($com);
$conn->close();