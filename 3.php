<?php
function DateToArray($date) {
    $arDate = explode(".", $date);

    $arNewDate = [
        "d" => $arDate[0],
        "m" => $arDate[1],
        "y" => $arDate[2],
    ];

    return $arNewDate;
}

function Compare($date1, $date2) {
    $arDate1 = DateToArray($date1);
    $arDate2 = DateToArray($date2);

    if ($arDate1["y"] < $arDate2["y"]) {
        return $arDate1;
    } elseif ($arDate1["y"] > $arDate2["y"]) {
        return $arDate2;
    } else {
        if ($arDate1["m"] < $arDate2["m"]) {
            return $arDate1;
        } elseif ($arDate1["m"] > $arDate2["m"]) {
            return $arDate2;
        } else {
            if ($arDate1["d"] < $arDate2["d"]) {
                return $arDate1;
            } elseif ($arDate1["d"] > $arDate2["d"]) {
                return $arDate2;
            } else {
                return [];
            }
        }
    }
}

$date1 = "18.10.1980";
$date2 = "17.10.1980";

$res = Compare($date1, $date2);

echo $res ? implode(".", $res) : "Даты равны!";