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
        $productId = $data['product_id'];

        if (!is_int($productId)) {
            $errors['product_id'] = 'Id продукт должен быть целым числом';
        } else {
            $pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
            $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :productId');
            $stmt->execute(['productId' => $productId]);
            $data = $stmt->fetch();

            if ($data === false) {
                $errors['product_id'] = 'Продукт не найден';
            }
        }
    } else {
        $errors['product_id'] = 'id продукта должен быть обязательно указан ';
    }

    return $errors;
}

$errors = validate($_POST);
print_r($errors);

