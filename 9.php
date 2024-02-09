<?php
function TimeToArray($time) {
    $arTime = explode(":", $time);
    return [
        "h" => $arTime[0],
        "m" => $arTime[1]
    ];
}

function Timetable($arStart, $arEnd) {
    $arTimetable = [];
    $start = $arStart["h"] * 60 + $arStart["m"];
    $end = $arEnd["h"] * 60 + $arEnd["m"];
    $now = $start;
    while (($now + 45) <= $end) {
        $h = floor($now / 60);
        $newNow = $now + 45;
        $newH = floor($newNow / 60);
        $arTimetable[] = [
            "start" => [
                "h" => $h, 
                "m" => ($now - ($h * 60))
            ],
            "end" => [
                "h" => $newH, 
                "m" => ($newNow - ($newH * 60))
            ]
        ];
        $now = $newNow + 10;
    }
    return $arTimetable;
}

$startTime = "09:05";
$endTime = "16:50";

$arRes = Timetable(TimeToArray($startTime), TimeToArray($endTime));
foreach ($arRes as $key => $value) {
    echo sprintf("%02d:%02d - %02d:%02d", $value["start"]["h"], $value["start"]["m"], $value["end"]["h"], $value["end"]["m"]) . "<br>";
}