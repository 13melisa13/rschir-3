<html lang="en">
<head>
<title>CITY №<?php echo $_GET["id"];?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<a href="index.php">Все города</a>

<?php

 $mysqli = new mysqli("db", "user", "password", "appDB");
$id=$mysqli ->real_escape_string($_GET["id"]);
 $result= $mysqli->query("SELECT * FROM city where id = '$id'");
if ($result->num_rows > 0){
    foreach($result as $row){
        echo "<form action='delete_city.php' method='post'> {$row['ID']} {$row['name']} 
 <button type='submit' name='delete_one'  value={$row['ID']}>Удалить</button>
 <a href='update_city.php?id={$row['ID']}'>Обновить</a></form>";}
} else{
    echo '404 not found';
}

?>


</body>
</html>