<?php
if (isset($_POST["name"])) {
    $conn = new mysqli("db", "user", "password", "appDB");
    $name = $conn->real_escape_string($_POST["name"]);
    $sql = $conn->query("INSERT INTO city (name)
                SELECT * FROM (SELECT $name) AS tmp
                WHERE NOT EXISTS (
                SELECT name FROM users WHERE name = $name
                ) LIMIT 1;");
    if($conn->query($sql)){
        echo "Данные успешно добавлены";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>
<html lang="en">
<head>
    <title>Create city</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<form action="create_city.php" method="post">
    <label for="name">Название города</label>
    <input type="text" name="name" id="name">
    <input type="submit" name="Создать">
</form>
</body>
</html>
