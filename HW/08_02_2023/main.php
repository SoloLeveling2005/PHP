<?php

$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'shop';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Создание таблицы categories, если её не существует
$sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(150) NOT NULL,
        parent_id INT(11),
        deleted_at DATETIME DEFAULT NULL,
        FOREIGN KEY (parent_id) REFERENCES categories(id)
)";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
}



if (isset($_POST['add_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $parent_id = (int) $_POST['parent_id'] ?: null;

    $sql = "INSERT INTO categories (name, parent_id) VALUES ('$name', $parent_id)";

    if (!mysqli_query($conn, $sql)) {
        echo "Error adding category: " . mysqli_error($conn);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>


<form action="" method="POST">
    <input type="text" name="name" placeholder="Название категории">
    <select name="parent_id">
        <option>Пункт 1</option>
        <option>Пункт 2</option>
    </select>

    <input type="submit" value="Добавить">
</form>