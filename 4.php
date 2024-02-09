<?php
function CountDaysInCurrentMonth($arDate) {
    $count = 28;
    while (checkdate($arDate[0], $count + 1, $arDate[2])) {
        $count++;
    }
    return $count;
}

$arDate = explode(".", date("m.d.Y"));
echo CountDaysInCurrentMonth($arDate);