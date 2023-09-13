<?php
$conn = new mysqli("db", "user", "password", "appDB");

if (isset($_POST["delete"]) && isset($_POST["cities"])) {
    $cities = $_POST["cities"];
    foreach ($cities as $city){
        $sql = "DELETE FROM city WHERE id = '$city'";

        if($result1 = mysqli_query($conn, $sql)){
//        echo "Данные успешно добавлены";
            header("Location: /index.php");
        } else{
            echo "Ошибка: " . $conn->error;
        }
    }

} elseif (isset($_POST["delete_one"])){
    $city = $_POST["delete_one"];
    $sql = "DELETE FROM city WHERE id = '$city'";
    if($result2 = mysqli_query($conn, $sql)){

        header("Location: /index.php");
//        echo "Данные успешно добавлены";
    } else {
        echo "Ошибка: " . $conn->error;
    }
} else {
    header("Location: /index.php");
//    echo "Данные успешно добавлены";
}

$conn->close();
?>