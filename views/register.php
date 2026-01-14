<div class="register-dropdown" id="registerDropdown">
    <form class="register-form" method="post" action="auth/register.php">
        <div class="register-field">
            <input type="text" name="first_name" placeholder="First name" required>
        </div>

        <div class="register-field">
            <input type="text" name="last_name" placeholder="Last name" required>
        </div>

        <div class="register-field">
            <input type="tel" name="phone" placeholder="Phone number" required>
        </div>

        <div class="register-field">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="register-field">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="register-field">
            <input type="password" name="password_confirm" placeholder="Confirm password" required>
        </div>

        <label class="register-checkbox">
            <input type="checkbox" required>
            <span>
                I agree with the <a href="#">Terms of use</a>
            </span>
        </label>

        <button type="submit" class="register-submit">
            Register
        </button>

        <div class="register-login">
            <span>Already have an account?</span>
            <button type="button" id="backToLogin" class="register-link">
                Login
            </button>
        </div>
    </form>
</div>