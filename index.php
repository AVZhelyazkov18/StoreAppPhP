<?php
require 'auth/bootstrap.php';
?>
<!DOCTYPE html>
<link rel="stylesheet" href="views/assets/css/products.css">
<link rel="stylesheet" href="views/assets/css/footer.css">
<link rel="stylesheet" href="views/assets/css/navbar.css">
<link rel="stylesheet" href="views/assets/css/login.css">
<link rel="stylesheet" href="views/assets/css/register.css">
<?php
require 'models/database.php';
require 'models/product.php';
require 'orders/bootstrap_products.php';

include 'views/navbar.php';
include 'views/login.php';
include 'views/register.php';
include 'views/cart-form.php';
include 'views/products.php';
include 'views/footer.php';
?>
<script src="views/assets/js/cart.js"></script>
<script src="views/assets/js/auth.js"></script>