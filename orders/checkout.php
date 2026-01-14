<?php

require '../auth/bootstrap.php';
require '../models/database.php';
require '../models/order.php';
require '../models/oitem.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

if (!isset($_COOKIE['cart'])) {
    header('Location: ../index.php');
    exit;
}

$cart = json_decode($_COOKIE['cart'], true);

if (!$cart || !is_array($cart)) {
    header('Location: ../index.php');
    exit;
}

$order = new Order(
    $_SESSION['user_id'],
    date('Y-m-d H:i:s')
);

$order_items = [];

foreach ($cart as $item) {
    $order_items[] = new OrderItem(
        $item['id'],
        $item['quantity'],
    );
}

try {
    $order_id = create_order($order, $order_items);
    
    setcookie('cart', '', time() - 3600, '/');
    
    header('Location: ../index.php?order=success&id=' . $order_id);
    exit;
} catch (Exception $e) {

    header('Location: ../index.php?order=error');
    exit;
}