<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lastpage.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['adiletkanybekovi']); ?></h1>

    <h2>Hi! My name is Adilet...</h2>

    <form action="add_comment.php" method="POST">
        <label for="comment">Leave your comment:</label><br>
        <textarea id="comment" name="comment" required></textarea><br>
        <input type="hidden" name="is_admin" value="<?php echo $_SESSION['is_admin']; ?>">
        <button type="submit">Send</button>
    </form>

    <h2>Comments</h2>
    <?php
    include 'config.php';

    // Подготовленный запрос для получения комментариев
    $sql = "SELECT users.username, comments.comment, comments.created_at, comments.is_admin 
            FROM comments 
            JOIN users ON comments.user_id = users.id 
            ORDER BY comments.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($row['username']) . "</strong> (" . htmlspecialchars($row['created_at']) . ")";
            if ($row['is_admin']) {
                echo " <strong>(Админ)</strong>";
            }
            echo ": " . htmlspecialchars($row['comment']) . "</p>";
        }
    } else {
        echo "<p>Нет комментариев</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

    <?php if ($_SESSION['is_admin']) { ?>
        <a href="admin_dashboard.php">Go to the admin panel</a>
    <?php } ?>

    <a href
