<html lang="en">
<head>
<title>Read city</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<h1>Таблица городов</h1>
<table>
    <tr><th>№</th><th>Название</th></tr>
<?php
 $mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM city");
foreach ($result as $row){
    echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td></tr>";
} 
?>
</table>
</body>
</html>