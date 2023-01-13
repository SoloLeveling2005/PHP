<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        td {
            width:100px;
            height: 20px;
            padding: 3px;
            text-align: center;
        }
    </style>
    <?php   
        $array = array(
            "ru"  => array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье"),
            "en"  => array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"),
        );

        // Задание 3
        $coll = 0;
        $num = 1000;
        // Вариант 1 (while)
        // while ($num > 50) {
        //     $coll += 1;
        //     $num = $num / 2;
        // }
        // Вариант 2 (for)
        for ($num; $num > 50; $num=$num/2) {
            $coll += 1;
        }


        // Вычисляем и выводим в консоль (задание 2)
        $sum = 0;
        for ($i = 1; $i <= 100; $i++) {
            if ($i%2==0) {
                $sum += $i;
            }   
        }
        
    ?>
    <script>
        console.log("Задание 2:")
        console.log("Сумма четных чисел в диапазоне от 1 до 100 = " + <?php echo $sum ?>)
        console.log("----------------------")
        console.log("Задание 3:")
        console.log("Количество итераций:" + <?php echo $coll ?> + " \nРезультат:" + <?php echo $num ?>)
    </script>
    <table>
        <h2>Задание 1</h2>
        <tr>
            <?php foreach($array["ru"] as $value) : ?>
                    <td><?php echo $value; ?></td> 
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach($array["en"] as $value) : ?>
                    <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
    <h2>Задание 2 (консоль)</h2>
    <h2>Задание 3 (консоль)</h2>

</body>
</html>