<?php
require '../models/database.php';
require 'bootstrap.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit;
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: ../');
    exit;
}

$stmt = $database->prepare(
    'SELECT id, first_name, password_hash, role FROM clients WHERE email = :email'
);
$stmt->execute(['email' => $_POST['email']]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: ../');
    exit;
}

if (!password_verify($_POST['password'], $user['password_hash'])) {
    header('Location: ../');
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_role'] = $user['role'];
$_SESSION['user_email'] = $_POST['email'];
$_SESSION['user_first_name'] = $user['first_name'];

header('Location: ../');
exit;