<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администраторская панель</title>
</head>
<body>
    <h1>Администраторская панель</h1>
    <p>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['adiletkanybekovi']); ?>!</p>

    <h2>Комментарии:</h2>
    <?php
    include 'config.php';

    // Подготовленный запрос для получения комментариев
    $sql = "SELECT comments.id, users.username, comments.comment, comments.created_at, comments.is_admin 
            FROM comments 
            JOIN users ON comments.user_id = users.id 
            ORDER BY comments.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($row['username']) . "</strong> (" . htmlspecialchars($row['created_at']) . ")";
            if ($row['is_admin']) {
                echo " <strong>(Админ)</strong>";
            }
            echo ": " . htmlspecialchars($row['comment']);
            echo " <a href='delete_comment.php?id=" . $row['id'] . "'>Удалить</a>";
            echo "</p>";
        }
    } else {
        echo "<p>Нет комментариев</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

    <a href="welcome.php">Назад к панели пользователя</a>
    <a href="logout.php">Выйти</a>
</body>
</html>
