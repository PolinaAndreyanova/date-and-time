<?php
function WorkTime($arDates) {
    $time = 0;
    foreach ($arDates as $key => $value) {
        $start = strtotime($value["start"]);
        $end = strtotime($value["end"]);
        $time += $end - $start;
    }
    $h = floor($time / 3600);
    $m = floor($time / 60) - ($h *60);
    return sprintf("%d часов, %d минут", $h, $m);
}

$arDates = [
    [
        "start" => "02.10.2017 10:12:11",
        "end" => "02.10.2017 15:20:11"
    ],
    [
        "start" => "03.10.2017 13:12:11",
        "end" => "03.10.2017 16:40:40"
    ]
];

$res = WorkTime($arDates);
echo $res;
