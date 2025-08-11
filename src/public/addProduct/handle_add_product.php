<?php
if (session_status() !== PHP_SESSION_ACTIVE ) {
    session_start();
}

if (!isset( $_SESSION['userId'])) {
    header("Location: /login");
    exit();
}


function validate(array $data) : array
{
    $errors = [];

    if (isset($data['product_id'])) {
        $productId = (int) $data['product_id'];

        $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :productId');
        $stmt->execute(['productId' => $productId]);
        $data = $stmt->fetch();

        if ($data === false) {
            $errors['product_id'] = 'Продукт не найден';
        }
    } else {
        $errors['product_id'] = 'id продукта должен быть обязательно указан ';
    }

    if (isset($data['amount'])) {
        $amount = $data['amount'];
    }

    return $errors;
}

$errors = validate($_POST);

if(empty($errors)) {
    $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');

    $userId = $_SESSION['userId'];
    $productId = $_POST['product_id'];
    $amount = $_POST['amount'];

    $stmt = $pdo -> prepare("SELECT * FROM user_products WHERE product_id = :productId AND user_id = :userId");
    $stmt -> execute(['productId' => $productId, 'userId' => $userId]);
    $data = $stmt ->fetch();

    if ($data === false) {
        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:userId, :productId, :amount)");
        $stmt -> execute(['userId' => $_SESSION['userId'], 'productId' => $productId, 'amount' => $amount]);
        echo 'продукты добавлены';
    } else {
        $amount = $data['amount'] + $amount;
        $stmt = $pdo -> prepare("UPDATE user_products SET amount = :amount WHERE user_id = :userId and product_id = :productId");
        $stmt -> execute(['amount' => $amount, 'userId' => $userId, 'productId' => $productId]);
        echo 'продукты добавлены повторно';
    }

}

