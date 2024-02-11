<?php
function Converter($sec) {
    $days = 0;
    $hours = 0;
    $min = 0;

    if ($sec >= 60) {
        $min = floor($sec / 60);
        $sec = $sec - ($min * 60);

        if ($min >= 60) {
            $hours = floor(($min / 60));
            $min = $min - ($hours * 60);

            if ($hours >= 24) {
                $days = floor($hours / 24);
                $hours = $hours - ($days * 24);
            }
        } 
    }

    return [$days, $hours, $min, $sec];
}


$sec = 1000;

$res = Converter($sec);

echo sprintf("%s дней %s часов %s минут %s секунд", ...$res);