<?php
$id = $_GET["id"];
$conn = new mysqli("db", "user", "password", "appDB");
if ($id){

if (isset($_POST["name"])) {

    $name = $conn->real_escape_string($_POST["name"]);

    $sql = "update city set name='$name' where id='$id'";
//    echo $sql;
    if ($result = mysqli_query($conn, $sql)) {

        header("Location: /index.php");
    } else {
        echo "Ошибка: " . $conn->error;

    }


}
}?>
<html lang="en">
<head>
    <title>UPD CITY №<?php echo $_GET["id"];?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<?php
if ($id) {
    $sql = "select * from city where id=$id";
    if ($result = mysqli_query($conn, $sql)) {
        if ($result ->num_rows>0)
        foreach ($result as $row) {

            echo "<form  method='post'>
    <label for='name'>Название города</label>
    <input type='text' name='name' id='name' value='{$row['name']}'>
    <input type='submit' value='Обновить'>
</form>";

        }
        else
            echo '404 not found';

    }
}
else{
    echo '404 not found';
}
    ?>


<a href="index.php">Все города</a>

</body>
</html>
<?php $conn->close(); ?>
