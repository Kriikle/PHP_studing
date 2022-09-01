<?php

function isGetSet(string $nameGet)
{
    if (isset($_GET[$nameGet])) {
        if ($_GET[$nameGet] === "" ){

            return 0;
        }

        return $_GET[$nameGet];
    }

    return 0;
}

function getPhoneNumber(string $nameGet): int
{
    if (isset($_GET[$nameGet])) {
        if ($_GET[$nameGet] === "" ){

            return 0;
        }
        preg_match_all('!\d+!', $_GET[$nameGet], $userPhone);
        $phoneNumber = implode("", $userPhone[0]);

        return intval($phoneNumber);
    }

    return 0;
}

