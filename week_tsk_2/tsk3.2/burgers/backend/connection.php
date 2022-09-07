<?php


function OpenCon(): mysqli
{
    $dbSettings = explode(';',file_get_contents('bdData.txt'));

    $dbhost = (string) $dbSettings[0];
    $dbuser = (string) $dbSettings[1];
    $dbpass = (string) $dbSettings[2];
    $db = (string) $dbSettings[3];


    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
    if ($conn->connect_error) {
        die("db Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function CloseCon($conn): void
{
    $conn->close();
}
