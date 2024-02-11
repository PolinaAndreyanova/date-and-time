<?php
function GetFirstMonday($year) {
    $day = 1;

    while (date("l", mktime(0, 0, 0, 1, $day, $year)) != "Monday") {
        $day++;
    }

    return [$day, 1, $year];
}

function Mondays($arFirstMonday, $arCurDate) {
    $arDates = [];
    [$day, $month, $year] = $arFirstMonday;
    [$curDay, $curMonth, $curYear] = $arCurDate;

    while (($month < $curMonth) || ($day < $curDay)) {
        $arDates[] = [$day, $month, $year];
        $arNewDate = explode(".", date("d.m.Y", (strtotime(implode(".", [$day, $month, $year])) + 604800)));
        [$day, $month, $year] = $arNewDate;
    }

    return $arDates;
}

$curYear = date("Y");

$res = Mondays(GetFirstMonday($curYear), explode(".", date("d.m.Y")));

foreach ($res as $value) {
    echo sprintf("%02d-%02d-%04d", ...$value) . "<br>";
}