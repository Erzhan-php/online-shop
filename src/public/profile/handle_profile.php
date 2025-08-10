<?php
session_start();
if (isset($_SESSION['userId']))
{
    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt -> execute(['id' => $_SESSION['userId']]);
    $user = $stmt ->fetch();

    if ($user) {
        // Если пользователь найден, подключаем профиль
        require_once './profile/get_profile.php';
            } else {
        // Если пользователь не найден
        echo "Пользователь не найден.";
            }
} else {
    // Если сессия не установлена — редирект на вход
    header('Location: /get_login.php');
    exit();
}
?>

<!--<!DOCTYPE html>-->
<!--<html lang="ru">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Профиль пользователя</title>-->
<!--    <link rel="stylesheet" href="styles.css">-->
<!--</head>-->
<!--<body>-->
<!--    <div class="profile-container">-->
<!--        <h2>Профиль пользователя</h2>-->
<!--        <div class="avatar">-->
<!--            <img src="uploads/--><?php //echo htmlspecialchars($user['avatar']); ?><!--" alt="Аватар пользователя">-->
<!--        </div>-->
<!--        <form>-->
<!--            <label for="name">Имя</label>-->
<!--            <input type="text" id="name" name="name" value="--><?php //echo htmlspecialchars($user['name']); ?><!--" readonly>-->
<!---->
<!--            <label for="email">Почта</label>-->
<!--            <input type="email" id="email" name="email" value="--><?php //echo htmlspecialchars($user['email']); ?><!--" readonly>-->
<!---->
<!--            <label for="password">Пароль</label>-->
<!--            <input type="password" id="password" name="password" value="****" readonly>-->
<!---->
<!--            <button type="button">Редактировать</button>-->
<!--        </form>-->
<!--    </div>-->
<!--</body>-->
<!--</html>-->