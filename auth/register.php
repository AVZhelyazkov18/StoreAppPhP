<?php
require '../models/database.php';
require 'bootstrap.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit;
}

if (
    empty($_POST['first_name']) ||
    empty($_POST['last_name']) ||
    empty($_POST['phone']) ||
    empty($_POST['email']) ||
    empty($_POST['password'])
) {
    header('Location: ../');
    exit;
}

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $database->prepare(
    'INSERT INTO clients (first_name, last_name, phone, email, password_hash)
     VALUES (:first_name, :last_name, :phone, :email, :password_hash)'
);

$stmt->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'password_hash' => $hash
]);

$_SESSION['user_id'] = $database->lastInsertId();
$_SESSION['user_email'] = $_POST['email'];
$_SESSION['user_first_name'] = $_POST['first_name'];

header('Location: ../');
exit;