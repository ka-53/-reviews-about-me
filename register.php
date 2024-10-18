<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$adminCode = $_POST['adminCode'];
$isAdmin = ($adminCode === '12345') ? 1 : 0;

// Подготовленный запрос для безопасной вставки данных
$stmt = $conn->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)");

// Проверьте, что подготовка прошла успешно
if (!$stmt) {
    die("Ошибка подготовки запроса: " . $conn->error);
}

// Привязываем параметры: "s" для строки, "i" для целого числа
$stmt->bind_param("ssi", $username, $password, $isAdmin);

// Выполняем запрос
if ($stmt->execute()) {
    echo "Регистрация прошла успешно!";
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
