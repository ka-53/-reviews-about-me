<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.html');
    exit();
}

include 'config.php';

$comment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Проверка, что id является положительным числом
if ($comment_id > 0) {
    // Подготовленный запрос для удаления комментария
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Неверный идентификатор комментария!";
}

$conn->close();
?>
