<?php
function readCSV($file) {
    $arDates = [];

    $fDates = fopen($file, "rt") or Die("Ошибка!");

    for ($i = 0; $arData = fgetcsv($fDates, 100); $i++) {
        $arDates[] = $arData;
    }

    fclose($fDates);

    return $arDates;
}

function writeCSV($file, $arDates) {
    $fDates = fopen($file, "a") or Die("Ошибка!");

    fputcsv($fDates, $arDates);

    fclose($fDates);
}

function DatePeriodConverter($arDatePeriod) {
    return [strtotime($arDatePeriod[0]), strtotime($arDatePeriod[1])];
}

function AddDates($new, $dates) {
    $isAdd = true;

    if (count($new) == 2) {
        [$newDateStart, $newDateEnd] = DatePeriodConverter($new);

        foreach ($dates as $value) {
            if (count($value) == 2) {
                [$bookedStart, $bookedEnd] = DatePeriodConverter($value);

                if (($newDateStart <= $bookedEnd) && ($newDateEnd >= $bookedStart)) {
                    // echo 1;
                    $isAdd = false;
                    break;
                }
            } else {
                $booked = strtotime($value[0]);

                if (($newDateStart <= $booked) && ($newDateEnd >= $booked)) {
                    // echo 2;
                    $isAdd = false;
                    break;
                }
            }
        }
    } else {
        $newDate = strtotime($new[0]);

        foreach ($dates as $value) {
            if (count($value) == 2) {
                [$bookedStart, $bookedEnd] = DatePeriodConverter($value);

                if (($newDate <= $bookedEnd) && ($newDate >= $bookedStart)) {
                    // echo 3;
                    $isAdd = false;
                    break;
                }
            } else {
                $booked = strtotime($value[0]);

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

$CSV_FILE = "dates.csv";

$dateStart = $_POST["dateStart"];
$dateEnd = $_POST["dateEnd"];
$arNewDates = [$dateStart];
if ($dateEnd) {
    if ($dateEnd !== $dateStart) {
        $arNewDates[] = $_POST["dateEnd"];
    }
}

$arDates = readCSV($CSV_FILE);

$res = AddDates($arNewDates, $arDates);

if ($res) {
    writeCSV($CSV_FILE, $arNewDates);
    print_r($arNewDates);
    $feedbsck = "Данную дату или период можно добавить в массив для нового бронирования";
} else {
    $feedbsck = "Данную дату или период нельзя добавить в массив для нового бронирования";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Статус бронирования</title>
    <style>
        input {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <p><?=$feedbsck?></p>
    <form action="12-form.php" method="post">
        <input type="submit" value="На главную!" />
    </form>
</body>
</html>