<?php


$errMsg = "";
if (!isset($_POST['title'])) {
    $errMsg .= "Введите title\n";
}
if (!isset($_POST['category'])) {
    $errMsg .= "Введите category\n";
}
if (!isset($_POST['description'])) {
    $errMsg .= "Введите description\n";
}
if (!isset($_POST['source'])) {
    $errMsg .= "Введите source\n";
}

if ($errMsg == "") {
    $req = $news->saveNews($_POST['title'],$_POST['category'],$_POST['description'],$_POST['source']);
    if ($req) {
        echo "Добавлено";
    } else {
        echo "Error";
    }

} else {
    echo "123";
}