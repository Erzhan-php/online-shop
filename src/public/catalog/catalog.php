<?php
//if (!isset($_COOKIE['user_id'])) {
//    header('Location: /get_login.php');
//}
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: /get_login.php');
}

$pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'USER', 'pass');
$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll();


require_once './catalog/catalog_page.php';
?>

