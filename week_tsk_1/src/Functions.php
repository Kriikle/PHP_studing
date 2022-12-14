<?php


//Задание #1

//Функция должна принимать массив строк и выводить каждую строку в отдельном параграфе (тег <p>)
//Если в функцию передан второй параметр true, то возвращать (через return) результат в виде одной объединенной строки.
function taskOne(array $stringList,bool $isReturn  = false): string //В конце тип возвращаемого значения
{

    $string = implode("</p><p>",$stringList);
    $line = '<p>'. $string .'</p>';
    if ($isReturn){
        return $line;
    }
    echo $line;
    return '';
}


//Задание #2

//Функция должна принимать переменное число аргументов.
//Первым аргументом обязательно должна быть строка, обозначающая арифметическое действие,
//которое необходимо выполнить со всеми передаваемыми аргументами.
//Остальные аргументы это целые и/или вещественные числа.
function minus_number($num):float
{
    return -$num;
}

function division_by_number($num):float
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

//Задание #3 (Использование рекурсии не обязательно)

//Функция должна принимать два параметра – целые числа.
//Если в функцию передали 2 целых числа,
// то функция должна отобразить таблицу умножения размером со значения параметров,
//переданных в функцию. (Например если передано 8 и 8,
//то нарисовать от 1х1 до 8х8). Таблица должна быть выполнена с использованием тега <table>
//В остальных случаях выдавать корректную ошибку.
function taskTree(int $a, int $b): string
{
    if ($a <= 0 || $b <= 0){
        //Second arg is error *must have
        trigger_error("Arguments must be positive", E_USER_ERROR);
    }
    $resultString = '<table>';
    for ($i = 1; $i <= $a; $i++) {
        $resultString .=  '<tr>';
        for ($j = 1; $j <= $b; $j++) {
            $num = $i * $j;
            $resultString .=  "<td> $num </td>";
        }
        $resultString = $resultString . '</tr>';
    }
    $resultString .=  '</table>';

    return $resultString;
}


//Задание #4

//Выведите информацию о текущей дате в формате 31.12.2016 23:59
//Выведите unix time время соответствующее 24.02.2016 00:00:00.
function taskFour(): string
{
    $returnStatement =  date("d.m.Y h:m");

    return $returnStatement . "\n" . strtotime('24.02.2016 00:00:00');
}



//Задание #5

//Дана строка: “Карл у Клары украл Кораллы”. Удалить из этой строки все заглавные буквы “К”.
//Дана строка: “Две бутылки лимонада”. Заменить “Две”, на “Три”.
function taskFive(): string
{
    $stringOne = "Карл у Клары украл Кораллы";
    $stringOne = str_replace("К", " ", $stringOne);
    $stringTwo = "Две бутылки лимонада";
    $stringTwo = str_replace("Две", "Три", $stringTwo);

    return $stringOne . "\n" . $stringTwo . "\n";
}


//Задание #6

//Создайте файл test.txt средствами PHP. Поместите в него текст - “Hello again!”
//Напишите функцию, которая будет принимать имя файла, открывать файл и выводить содержимое на экран.
function taskSix(string $file_name, bool $isCreateFile = true): string
{
    if ($isCreateFile) {
        //$fw = fopen("test.txt",'w+');
        //fwrite($fw,'Hello again!');
        //fclose($fw);
        file_put_contents("test.txt", 'Hello again!');
    }

    return file_get_contents($file_name);
    //return readfile($file_name);//+число
}

