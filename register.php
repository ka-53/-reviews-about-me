<?php
include 'config.php';

$username = $_POST['adiletkanybekovi'];
$password = password_hash($_POST['730419Mama'], PASSWORD_DEFAULT);
$adminCode = $_POST['adminCode']; // Новый код администратора

// Определяем, является ли пользователь администратором
$isAdmin = $adminCode === '12345'; // Замените YOUR_ADMIN_CODE на ваш реальный код администратора

// SQL-запрос для вставки данных в таблицу пользователей
$sql = "INSERT INTO users (adiletkanybekovi, 730419Mama, is_admin) VALUES ('$username', '$password', '$isAdmin')";

if (mysqli_query($conn, $sql)) {
    echo "Регистрация прошла успешно!";
} else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>
        Успешно Зарегистрировались!
    </h1>
     <a href="login.html">Войти</a>
</body>
</html>
