<?php


function getUserByEmail(string $email): array
{
    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

function validateLoginForm(array $arrPost) : array
{
    $errors = [];

    if(isset($arrPost['email'])) {
        $email = $arrPost['email'];
    } else {
        $errors['email'] = 'Введите ваш Email';
    }

    if (isset($arrPost['psw'])) {
        $password = $arrPost['psw'];
    } else {
        $errors['password'] = 'Введите ваш Password';
    }

    if(empty($email)) {
        $errors['email'] = 'Email не может быть пустым';
    } elseif (strlen($email) < 6) {
        $errors['email'] = 'Email не может меньше 5 символов';
    } elseif (getUserByEmail($email) === false) {
        $errors['email'] = 'Пользователя с таким Email не существует';
    } else {
        $arrUser = getUserByEmail($email);
    }

    if(empty($password)) {
        $errors['password'] = 'Password не может быть пустым';
    } elseif (strlen($password) < 5) {
        $errors['password'] = 'Password не может быть меньше 5 символов';
    } elseif (empty($errors['password'])) {
        if (!password_verify($password, $arrUser['password'])) {
            $errors['password'] = 'Поле Email или Password указаны не верно';
        }
    }

    return $errors;
}

$errors = validateLoginForm($_POST);

if (empty($errors)) {
    echo 'Вход выполнен успешно';
}

require_once ('./get_login.php');





//1 найти пользователя в бд с указанным логином.Если пользователя нет,то отдать валидац. ошибку
//2 если поозьватель есть проверить пароли на совпадение
//3 cookie
?>
