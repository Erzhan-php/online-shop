<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="profile-container">
    <h2>Профиль пользователя</h2>
    <div class="avatar">
        <img src="avatar.jpg" alt="Аватар пользователя">
    </div>
    <form>
        <label for="name">Имя</label>
        <input type="text" id="name" name="name" value=<?php echo $user["name"]; ?>>

        <label for="email">Почта</label>
        <input type="email" id="email" name="email" value=<?php echo $user['email']; ?>>

        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" value="****" readonly>
        <form action="../editProfile/handle_edit_profile.php" method="post">
        <button type="submit">Редактировать</button>
            // сюда наверное надо добавить редирект что бы отсюда можно была сразу изменить данные, а не отправлять пользователя на 
        </form>
    </form>
</div>
</body>
</html>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .profile-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    .profile-container h2 {
        margin-bottom: 15px;
    }

    .avatar {
        margin-bottom: 15px;
    }

    .avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 2px solid #ddd;
    }

    .profile-container label {
        display: block;
        text-align: left;
        margin: 10px 0 5px;
    }

    .profile-container input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f0f0f0;
        cursor: not-allowed;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #5c67f2;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background: #4a54e1;
    }
</style>