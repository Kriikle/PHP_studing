<?php


//Задание #1

//Функция должна принимать массив строк и выводить каждую строку в отдельном параграфе (тег <p>)
//Если в функцию передан второй параметр true, то возвращать (через return) результат в виде одной объединенной строки.
function taskOne(array $stringList,bool $isReturn  = false)//: string //В конце тип возвращаемого значения
{

    $string = implode("</p><p>",$stringList);
    $line = '<p>'. $string .'</p>';
    if ($isReturn){
        return $line;
    }
    echo $line;//return не всегда вызваеться поэтому :string не подходит
}


//Задание #2

//Функция должна принимать переменное число аргументов.
//Первым аргументом обязательно должна быть строка, обозначающая арифметическое действие,
//которое необходимо выполнить со всеми передаваемыми аргументами.
//Остальные аргументы это целые и/или вещественные числа.
function minus_number($num)
{
    return -$num;
}

function division_by_number($num)
{
    if ($num === 0){
        return 1;
    }
    return 1/$num;
}

function taskTwo(string $mathSymbol,...$numbers):float
{
    $result = 0;
    switch ($mathSymbol){
        case '+':
            $result = array_sum($numbers);
            break;
        case '-':
            $numbers = array_map('minus_number', $numbers);
            $result = array_sum($numbers);
            break;
        case '*':
            $result = array_product($numbers);
            break;
        case '/':
            //zero become one in division_by_number
            $numbers = array_map('division_by_number', $numbers);
            $result = array_product($numbers);
            break;
    }

    return $result;
}

function taskTree(int $a,int $b):string
{
    return $a+$b;
}