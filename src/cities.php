<html lang="en">
<head>
<title>cities</title>
    <link rel="stylesheet" href="static/style.css" type="text/css"/>
</head>
<body>
<a href="create_city.php">Создать город</a>


<h1>Таблица городов</h1>
<form action='delete_city.php' method='post'>

<table>
    <tr>
        <th><input type="checkbox"  id="select_all""></th>
        <th>№</th><th>Название</th>
        <th><input type='submit' name="delete" value='Удалить выбранные'></th>
        <th>upd</th></tr>
<?php
 $mysqli = new mysqli("db", "user", "password", "appDB");
$result = $mysqli->query("SELECT * FROM city ORDER BY id ");
foreach ($result as $row){
    echo "<tr>
<td> <input type='checkbox' name='cities[]' value={$row['ID']}>

</td>
<td>{$row['ID']}</td>
<td><a href='city.php?id={$row['ID']}'>{$row['name']}</a></td>

<td><button type='submit' name='delete_one'  value={$row['ID']}>Удалить</button></td>
<td><a href='update_city.php?id={$row['ID']}'>Обновить</a></td>
</tr>";
} 
?>
</table>
</form>
<script>
    let select_all = document.getElementById('select_all');
    let checkboxes = document.getElementsByName('cities[]');
    console.log(select_all)
    select_all.addEventListener('change', function() {
        for (const checkbox of checkboxes) {
            checkbox.checked = select_all.checked
        }
    });

</script>
</body>
</html>