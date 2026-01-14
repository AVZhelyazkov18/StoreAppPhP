<!DOCTYPE html>
<div class="cart-dropdown" id="cartDropdown">
    <div class="cart-row">
        <span>Products:</span>
        <span id="cartProductsPrice">0.00 €</span>
    </div>
    <div class="cart-items" id="cartItems"></div>
    <div class="cart-row">
        <span>Delivery:</span>
        <span>0.00 €</span>
    </div>

    <div class="cart-total">
        <span>Total:</span>
        <span id="cartFinalPrice">0.00 €</span>
    </div>

    <div class="cart-warning">
        To order, minimum amount is 5.00 €
    </div>

    <form method="post" action="orders/checkout.php">
        <button class="cart-pay-button" id="payButton" type="submit">
            Pay
        </button>
    </form>
</div>