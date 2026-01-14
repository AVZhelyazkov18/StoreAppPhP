<!DOCTYPE html>
<nav class="navbar">
    <div class="navbar-left">
        <img src="views/assets/images/logo.png" alt="Logo" class="navbar-logo">

        <?php if (isset($_SESSION['user_first_name'])): ?>
            <span class="navbar-welcome">
                Welcome, <?= $_SESSION['user_first_name'] ?>!
            </span>
        <?php endif; ?>
    </div>

    <div class="navbar-center">
        <form class="search-form" method="get" action="">
            <input
                type="text"
                name="q"
                placeholder="Search products..."
                value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
            <button class="search-button" type="submit">
                <img src="views/assets/images/search.png" alt="Search">
            </button>
        </form>
    </div>

    <div class="navbar-right">

        <?php if (!isset($_SESSION['user_id'])): ?>

            <button class="navbar-login" id="loginButton" type="button">
                <span class="login-icon">👤</span>
                <span>Login</span>
            </button>

        <?php else: ?>

            <form action="auth/logout.php" method="post">
                <button class="navbar-login" type="submit">
                    <span class="login-icon">👤</span>
                    <span>Logout</span>
                </button>
            </form>

        <?php endif; ?>

        <button class="navbar-cart" id="cartButton" type="button">
            <span class="cart-icon">🛒</span>
            <span class="cart-info">
                <span id="cartCount">0 Products</span>
                <span id="cartTotal">Price: 0.00 €</span>
            </span>
        </button>
    </div>
</nav>