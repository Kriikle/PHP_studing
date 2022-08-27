<?php


function OpenCon(): mysqli
{
    $dbSettings = explode(';',file_get_contents('bdData.txt'));

    $dbhost = "$dbSettings[0]";
    $dbuser = "$dbSettings[1]";
    $dbpass = "$dbSettings[2]";
    $db = "$dbSettings[3]";


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
