document.addEventListener('DOMContentLoaded', function () {
    const cartButton = document.getElementById('cartButton');
    const cartDropdown = document.getElementById('cartDropdown');

    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');
    const cartProductsPrice = document.getElementById('cartProductsPrice');
    const cartFinalPrice = document.getElementById('cartFinalPrice');
    const payButton = document.getElementById('payButton');

    const registerDropdown = document.getElementById('registerDropdown');
    const loginDropdown = document.getElementById('loginDropdown');

    cartButton.addEventListener('click', function (e) {
        e.stopPropagation();

        if (registerDropdown && registerDropdown.classList.contains('active')) {
            registerDropdown.classList.remove('active');
        } else if (loginDropdown && loginDropdown.classList.contains('active')) {
            loginDropdown.classList.remove('active');
        }

        cartDropdown.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        if (!cartDropdown.contains(e.target) && !cartButton.contains(e.target)) {
            cartDropdown.classList.remove('active');
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('cart-item-remove')) {
            const id = parseInt(e.target.dataset.id);
            let cart = getCart();

            cart = cart.filter(p => p.id !== id);

            saveCart(cart);
            updateCartUI();
        }
    });

    function getCart() {
        const item = document.cookie
            .split('; ')
            .find(row => row.startsWith('cart='));

        return item ? JSON.parse(decodeURIComponent(item.split('=')[1])) : [];
    }

    function saveCart(cart) {
        document.cookie =
            "cart=" +
            encodeURIComponent(JSON.stringify(cart)) +
            "; path=/";
    }

    window.addToCart = function (product) {
        if (product.unit_type === 'PCS') {
            product.quantity = Math.floor(product.quantity);
        }
        if (product.quantity <= 0 || isNaN(product.quantity)) {
            return;
        }

        const cart = getCart();
        const existing = cart.find(p => p.id === product.id);

        if (existing) {
            existing.quantity += product.quantity;
        } else {
            cart.push(product);
        }

        saveCart(cart);
        updateCartUI();
    };

    function calculateTotal(cart) {
        return cart.reduce((sum, p) => sum + p.price * p.quantity, 0);
    }

    function updateCartUI() {
        const cart = getCart();
        const total = calculateTotal(cart);

        if (payButton) {
            if (total < 5) {
                payButton.disabled = true;
                payButton.textContent = "Insufficient Product Amount"
            } else {
                payButton.disabled = false;
                payButton.textContent = "Pay"
            }
        }

        const cartItemsEl = document.getElementById('cartItems');

        if (cartItemsEl) {
            cartItemsEl.innerHTML = '';

            cart.forEach(product => {
                const item = document.createElement('div');
                item.className = 'cart-item';

                item.innerHTML = `
                <div class="cart-item-info">
                    <div class="cart-item-name">${product.name}</div>
                    <div class="cart-item-qty">
                        ${product.quantity} x ${product.price.toFixed(2)} €
                    </div>
                </div>

                <div class="cart-item-price">
                    ${(product.price * product.quantity).toFixed(2)} €
                </div>

                <button class="cart-item-remove" data-id="${product.id}">
                    ×
                </button>
            `;

                cartItemsEl.appendChild(item);
            });
        }

        if (cartCount) {
            cartCount.innerText = cart.length + " Products";
        }

        if (cartTotal) {
            cartTotal.innerText = "Price: " + total.toFixed(2) + " €";
        }

        if (cartProductsPrice) {
            cartProductsPrice.innerText = total.toFixed(2) + " €";
        }

        if (cartFinalPrice) {
            cartFinalPrice.innerText = total.toFixed(2) + " €";
        }
    }

    updateCartUI();
});