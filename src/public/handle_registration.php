<?php
//это для себя, что бы лучше понять
//if(isset($arr['name'])) {
//    $name = $_POST['name'];
//
//    if(empty($name)) {
//        $errors[] = 'name не должно быть пустым';
//    } elseif (strlen($name) < 2) {
//        $errors[] = 'name должно быть больше 2 символов';
//    }

//}
function validateLoginForm(array $methodPost) : array
{
    $errors = [];

    if (isset($methodPost['name'])) {
        $name = $methodPost['name'];
    } else {
        $errors['name'] = 'Поле Name не должно быть пустым';
    }

    if (isset($methodPost['email'])) {
        $email = $methodPost['email'];
    } else {
        $errors['email'] = 'Поле Email не должно быть пустым';
    }

    if (isset($methodPost['psw'])) {
        $password = $methodPost['psw'];
    } else {
        $errors['psw'] = 'Поле Password не должно быть пустым';
    }

    if (isset($methodPost['psw-repeat'])) {
        $passwordRepeat = $methodPost['psw-repeat'];
    } else {
        $errors['psw-repeat'] = 'Поля PasswordRepeat не должно быть пустым';
    }

    if (empty($name)) {
        $errors['name'] = 'заполните поле name';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'поле name должно содержать не менее 2 символов';
   //  } elseif {//вот здесь нету условия, поэтому ошибка выходит
   //     $errors['name'] = 'значение name должно существовать';
    }

    if (empty($email)) {
        $errors['email'] = 'заполните поле email';
    } elseif (strpos($email, '@') === false) {
        $errors['email'] = 'поле email должно содержать символ @';
    } elseif (strlen($email) < 6)  {
        $errors['email'] = 'поле email должно быть содержать больше 6 символов';
    }

    if (empty($password)) {
        $errors['password'] = 'заполните поле password';
    } elseif (strlen($password) < 4)  {
        $errors['password'] = 'поле password должно быть содержать больше 4 символов';
    } elseif (is_numeric($password))  {
        $errors['password'] = 'поле password должно содержать не только цифры';
    //} elseif ($password !== $passwordRep) {
     //   $errors['password'] = 'Пароли не совпадают';
    }


    if (empty($passwordRep)) {
        $errors['passwordRep'] = 'Повтор пароля не должен быть пустым';
    } elseif  ($password !== $passwordRep) {
        $errors['passwordRep'] = 'Пароли не совпадают';
    }

    return $errors;
}

$errors = validateLoginForm($_POST);

if(empty($errors)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $passwordRep = $_POST['psw-repeat'];

    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

    $hash = password_hash($password, PASSWORD_DEFAULT);;

    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hash]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    print_r($stmt->fetch());
    echo 'Добро пожаловать';
}
require_once './get_registration.php';
?>



















