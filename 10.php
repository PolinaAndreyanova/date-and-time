<?php
function IsOpen($date, $time, $arTimetable) {
    $w = date("w", strtotime($date));

    $arTime = explode(":", $time);
    $formatTime = $arTime[0] * 60 + $arTime[1];

    $formatArTimetable = explode(" ", $arTimetable[$w]);

    $arStart = explode(":", $formatArTimetable[1]);
    $start = $arStart[0] * 60 + $arStart[1];

    $arEnd = explode(":", $formatArTimetable[3]);
    $end = $arEnd[0] * 60 + $arEnd[1];
    
    if (($start < $formatTime) && ($formatTime < $end)) {
        $h = floor(($end - $formatTime) / 60);
        $m = ($end - $formatTime) - ($h * 60);

        return [
            "Магазин работает",
            sprintf("До закрытия %d часов %d минут", $h, $m)
        ];
    }

    return [
        "Магазин не работает",
        ""
    ];
}

$arTimetable = [
    "ВС 10:00 – 18:00",
    "ПН 9:00 – 21:00",
    "ВТ 9:00 – 21:00",
    "СР 9:00 – 21:00",
    "ЧТ 9:00 – 21:00",
    "ПТ 9:00 – 21:00",
    "СБ 10:00 – 18:00"
];

$date = "13.02.2024";
$time = "10:15";

echo sprintf("%s. %s", ...IsOpen($date, $time, $arTimetable));