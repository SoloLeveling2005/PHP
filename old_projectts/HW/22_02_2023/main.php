<?php
// Подключение к базе данных
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'shop';

$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Создание таблицы categories, если её не существует
$sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(150) NOT NULL,
        parent_id INT(11),
        deleted_at DATETIME DEFAULT NULL,
        FOREIGN KEY (parent_id) REFERENCES categories(id)
)";

$db->exec($sql);

// Обработка формы добавления новой категории
if (isset($_POST['name'])) {
    $name = (string) $_POST['name'];
    $parent_id = (int) $_POST['parent_id'] ?: null;

    $sql = "INSERT INTO categories (name, parent_id) VALUES (?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$name, $parent_id]);

    echo "Добавлено";
}

// Обработка запроса на удаление категории
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    echo "Удалено";
}
if (isset($_POST['up_name'])) {
    $up_id = (int) $_POST['up_id'];
    $up_name = (string) $_POST['up_name'];

    $sql = "UPDATE categories SET name=?  WHERE id = ? ";
    $stmt = $db->prepare($sql);
    $stmt->execute([$up_name, $up_id]);

    echo "Обновлен";
}

// Получение списка категорий
$sql = "SELECT cat.id as 'id', cat.name as 'name', cat.parent_id as 'parent_id', categories.name as 'parentName' 
FROM categories as cat 
LEFT JOIN categories ON categories.id = cat.parent_id;
";
$stmt = $db->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
    body {
        padding: 10px;
    }
    .list {
        margin-top: 10px;
    }
    table {
        width: 70vw;
        border-spacing: 0px;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        border: 1px solid black;
    }
</style>

<form action="" method="POST">
    <input type="text" name="name" placeholder="Название категории"><br>
    <select name="parent_id">
        <option>Нет родительской категории</option>
        <?php foreach ($data as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Добавить">
</form>



<table class="list">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Parent Name</th>
        <th>Save change categories</th>
        <th>Delete categories</th>
    </tr>
    <?php foreach ($data as $category){?>
        <tr>
            <form action="" method="POST">
                <input type="hidden" value="<?=$category['id']?>" name="up_id">
                <td class="id"><?=$category['id']?></td>
                <td class="name"><input type="text" value="<?=$category['name']?>" name="up_name"></td>
                <td class="parent-name">
                    <?=$category['parentName']?:'Нету'?>
                </td>
                <td class="update-td">
                    <input type="submit" value="Update" style="color:green; background-color: white; border: 1px solid black;padding: 5px 12px;">
                </td>
            </form>
            <td class="delete-td">
                <form action="" method="POST">
                    <input type="hidden" name="del_id" value="<?=$category['id']?>">
                    <input type="submit" value="Delete" style="color:red; background-color: white; border: 1px solid black;padding: 5px 12px;">
                </form>
            </td>
        <tr/>
    <?php } ?>
</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
