<?php
$servername = "mysql.about-me.shop";
$username = "adiletkanybekovi";
$password = "730419Mama"; // Используйте переменные окружения для безопасности
$dbname = "lyudi";

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Функция для фильтрации входных данных
function filter_input_data($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
