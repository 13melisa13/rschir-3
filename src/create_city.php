<?php
if (isset($_POST["name"])) {
    $conn = new mysqli("db", "user", "password", "appDB");
    $name = $conn->real_escape_string($_POST["name"]);
    $sql = "INSERT IGNORE INTO city (name) VALUES ('$name')";

    if ($result = mysqli_query($conn, $sql)) {
//        echo "Данные успешно добавлены";
        header("Location: /index.php");
    }
    else {
        echo "Ошибка: " . $conn->error;

    }
    $conn->close();


}?>    <html lang="ru">
<head>
    <title>Create city</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<form method="post" >
    <label for="name">Название города</label>
    <input type="text" name="name" id="name">
    <input type="submit" value="Создать">
</form>

<a href="index.php">Все города</a>
</body>
</html>
