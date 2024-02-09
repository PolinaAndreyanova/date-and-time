<?php
function AddDates($new, $dates) {
    $isAdd = true;
    if (str_contains($new, " - ")) {
        $arNew = explode(" - ", $new);
        $newDateStart = strtotime($arNew[0]);
        $newDateEnd = strtotime($arNew[1]);
        foreach($dates as $key => $value) {
            if (str_contains($value, " - ")) {
                $arValue = explode(" - ", $value);
                $bookedStart = strtotime($arValue[0]);
                $bookedEnd = strtotime($arValue[1]);
                if (($newDateStart <= $bookedEnd) && ($newDateEnd >= $bookedStart)) {
                    // echo 1;
                    $isAdd = false;
                    break;
                }
            } else {
                $booked = strtotime($value);
                if (($newDateStart <= $booked) || ($newDateEnd >= $booked)) {
                    // echo 2;
                    $isAdd = false;
                    break;
                }
            }
        }
    } else {
        $newDate = strtotime($new);
        foreach($dates as $key => $value) {
            if (str_contains($value, " - ")) {
                $arValue = explode(" - ", $value);
                $bookedStart = strtotime($arValue[0]);
                $bookedEnd = strtotime($arValue[1]);
                if (($newDate <= $bookedEnd) || ($newDate >= $bookedStart)) {
                    // echo 3;
                    $isAdd = false;
                    break;
                }
            } else {
                $booked = strtotime($value);
                if ($newDate == $booked) {
                    // echo 4;
                    $isAdd = false;
                    break;
                }
            }
        }
    }
    return $isAdd;
}

$dates = [
    "12.09.2017", 
    "14.09.2017 - 02.10.2017"
];

$res = AddDates("05.09.2017 - 13.09.2017", $dates);

if ($res) {
    echo "Данную дату или период можно добавить в массив для нового бронирования";
} else {
    echo "Данную дату или период нельзя добавить в массив для нового бронирования";
}