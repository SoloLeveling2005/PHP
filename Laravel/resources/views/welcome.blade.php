<?php
// Задача 1. Напишите функцию которая проверяет, что строка начинается на 'http://' . Если это так – верните true, если не так – false.
echo "<h2>Задача 1</h2>";
$url_http = "http://";
$url_https = "https://";

function checkUrl(string $url){
    if (str_starts_with($url, "http://")) {
        return true;
    } else {
        return false;
    }
}
print("url_http = ".checkUrl($url_http)."<br>"); // Выводит 1
print("url_https = ".checkUrl($url_https)); // Выводит ничего





// Задача 2. Напишите функцию, которая определяет пол по ФИО.
echo "<br><br><br><br><br>";
echo "<h2>Задача 2</h2>";
$data_names = [
    'mans' => ['Мансур', 'Кирилл', 'Егор'],
    'womans' => ['Настя', 'Катя', 'Герда']
];
$data_input = ['Герда', 'Кирилл', 'Мансур'];

function manOrWoman(array $verification, array $reconciliation) { // проверка, сверка
    foreach ($verification as $key => $value) {
        if (in_array($value, $reconciliation['mans'], false)) {
            echo "$value: мужик";
        }
        if (in_array($value, $reconciliation['womans'], false)) {
            echo "$value: девушка";
        }
        echo "<br>";
    }
}
manOrWoman($data_input, $data_names);


// Задача 3. Напишите функцию getDivisors, которая параметром принимает число и возвращает массив его делителей (чисел, на которое делится данное число).
echo "<br><br><br><br><br>";
echo "<h2>Задача 3</h2>";

function getDivisors(int $number):array {
    $massDell = [];
    $number_old = $number;
    do {
        if ($number_old%$number==0) {
            $massDell[] = $number;
        }
        $number -= 1;
    } while ($number > 1);
    $massDell[] = 1;
    echo "Число $number_old<br>";
    return $massDell;
}

echo '<pre>';

print_r(getDivisors(10));
echo '</pre>';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        
    </body>
</html>
