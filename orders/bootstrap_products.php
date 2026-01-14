<?php
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($search !== '') {
    $products = search_products($search);
} else {
    $products = list_products();
}