<?php
function Dates($month) {
    $year = date('Y');
    $day = 1;
    $arDates = [];

    while (checkdate($month, $day, $year)) {
        $arDates[] = [$day, $month, $year];
        $day++;
    }

    return $arDates;
}

$month = 4;

$arDates = Dates($month);

foreach ($arDates as $value) {
    echo sprintf("%02d-%02d-%04d", ...$value) . "<br>";
}