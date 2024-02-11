<?php
function CountDays($date) {
    $now = strtotime(date("d.m.Y H:i:s"));
    $count = floor(($now - $date) / 86400);

    if ($count > 0) {
        return sprintf("Прошло %d дней", $count);
    } else {
        return sprintf("Осталось %d дней", abs($count));
    }
}

$date = "01.03.2024";

$res = CountDays(strtotime($date));

echo $res;