document.addEventListener('DOMContentLoaded', function () {

    const loginButton = document.getElementById('loginButton');
    const loginDropdown = document.getElementById('loginDropdown');
    const registerDropdown = document.getElementById('registerDropdown');
    const cartDropdown = document.getElementById('cartDropdown');

    const registerLink = document.querySelector('.login-register a');
    const backToLogin = document.getElementById('backToLogin');

    if (loginButton && loginDropdown) {
        loginButton.addEventListener('click', function (e) {
            e.stopPropagation();

            if (registerDropdown && registerDropdown.classList.contains('active')) {
                registerDropdown.classList.remove('active');
            } else {
                loginDropdown.classList.toggle('active');
            }

            if (cartDropdown && cartDropdown.classList.contains('active')) {
                cartDropdown.classList.remove('active');
            }
        });
    }

    if (registerLink && loginDropdown && registerDropdown) {
        registerLink.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            loginDropdown.classList.remove('active');
            registerDropdown.classList.add('active');
        });
    }

    if (backToLogin && loginDropdown && registerDropdown) {
        backToLogin.addEventListener('click', function (e) {
            e.stopPropagation();
            
            registerDropdown.classList.remove('active');
            loginDropdown.classList.add('active');
        });
    }

    document.addEventListener('click', function (e) {
        if (
            loginDropdown &&
            loginButton &&
            !loginDropdown.contains(e.target) &&
            !loginButton.contains(e.target)
        ) {
            loginDropdown.classList.remove('active');
        }

        if (
            registerDropdown &&
            !registerDropdown.contains(e.target) &&
            !loginButton?.contains(e.target)
        ) {
            registerDropdown.classList.remove('active');
        }
    });
});