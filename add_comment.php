<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$comment = filter_input_data($_POST['comment']);
$is_admin = $_SESSION['is_admin'] ? 1 : 0; // Убедитесь, что is_admin - это 1 или 0

// Подготовленный запрос для вставки комментария
$sql = "INSERT INTO comments (user_id, comment, is_admin) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $user_id, $comment, $is_admin);

if ($stmt->execute()) {
    header('Location: welcome.php');
} else {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
