<?php
function Timetable($data) {
    $arTimetable = [];
    $now = strtotime($data);
    $stop = $now + (30 * 86400);
    while ($now < $stop) {
        if (date("w", $now) == 0) {
            $now += 86400;
        }
        $arTimetable[] = date("d.m.Y", $now);
        $now += (4 * 86400);
    }
    return $arTimetable;
}

$date = "01.02.2024";
$arRes = Timetable($date);
foreach ($arRes as $key => $value) {
    echo $value . "<br>";
}