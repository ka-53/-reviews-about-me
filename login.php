<?php
include 'config.php';

$username = filter_input_data($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Подготовленный запрос для получения данных пользователя
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['adiletkanybekovi'] = $row['username'];
        $_SESSION['is_admin'] = $row['is_admin'];

        if ($row['is_admin']) {
            header('Location: admin_dashboard.php'); // Администраторская панель
        } else {
            header('Location: welcome.php'); // Обычная панель пользователя
        }
    } else {
        echo "Неверный пароль!";
    }
} else {
    echo "Пользователь не найден!";
}

$stmt->close();
$conn->close();
?>
