<?php
session_start();

function validateImput(array $data): array
{
    $errors=[];
    if (isset($data['name'])) {
        $name = $data['name'];

        if (empty($name)) {
            $errors['name'] = 'заполните поле name';
        } elseif (strlen($name) < 2) {
            $errors['name'] = 'поле name должно содержать не менее 2 символов';
            //  } elseif {//вот здесь нету условия, поэтому ошибка выходит
            //     $errors['name'] = 'значение name должно существовать';
        }
    }

    if (isset($data['email'])) {
        $email = $data['email'];

        if (empty($email)) {
            $errors['email'] = 'заполните поле email';
        } elseif (strpos($email, '@') === false) {
            $errors['email'] = 'поле email должно содержать символ @';
        } elseif (strlen($email) < 6)  {
            $errors['email'] = 'поле email должно быть содержать больше 6 символов';
        } else {
            $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt ->execute(['email' => $email]);
            $userData = $stmt -> fetch();

            if ($userData['email'] === $email) {
                $errors['email'] = 'Email уже зарегистрирован';
            }
        }
    } else {
        $errors['email'] = 'Поле Email не должно быть пустым';
    }

    if (isset($methodPost['psw'])) {
        $password = $methodPost['psw'];
        if (empty($password)) {
            $errors['psw'] = 'заполните поле password';
        } elseif (strlen($password) < 4)  {
            $errors['psw'] = 'поле password должно быть содержать больше 4 символов';
        } elseif (is_numeric($password))  {
            $errors['psw'] = 'поле password должно содержать не только цифры';
        }
    } else {
        $errors['psw'] = 'Поле Password не должно быть пустым';
    }

    if (isset($methodPost['psw-repeat'])) {
        $passwordRep = $methodPost['psw-repeat'];

        if (empty($passwordRep)) {
            $errors['psw-repeat'] = 'Повтор пароля не должен быть пустым';
        } elseif  ($password !== $passwordRep) {
            $errors['psw-repeat'] = 'Пароли не совпадают';
        }

    } else {
        $errors['psw-repeat'] = 'Поля PasswordRepeat не должно быть пустым';
    }
//
    return $errors;
}

if (!isset($_SESSION['userId']))
    {
        header('Location: login.php');
    }

$errors = [];
$errors = validateImput($_POST);
if (empty($errors))
    {
        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
        $psw = password_hash($_POST['psw'], PASSWORD_DEFAULT);;
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        // Выполняем запрос, передавая параметры
        $stmt->execute([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $psw,
            'id' => $_SESSION['userId']
        ]);
    }




require_once './get_edit_profile.php';