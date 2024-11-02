document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const togglePassword = document.querySelector('.toggle-password');

    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('fa-eye');
        togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Client-side validation
    loginForm.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Reset error messages
        emailError.textContent = '';
        passwordError.textContent = '';

        // Email validation
        if (!emailInput.value.trim()) {
            emailError.textContent = 'Email is required';
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            emailError.textContent = 'Please enter a valid email address';
            isValid = false;
        }

        // Password validation
        if (!passwordInput.value) {
            passwordError.textContent = 'Password is required';
            isValid = false;
        } else if (passwordInput.value.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters long';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Email validation helper function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Add input event listeners for real-time validation
    emailInput.addEventListener('input', function() {
        if (this.value.trim()) {
            if (!isValidEmail(this.value.trim())) {
                emailError.textContent = 'Please enter a valid email address';
            } else {
                emailError.textContent = '';
            }
        } else {
            emailError.textContent = '';
        }
    });

    passwordInput.addEventListener('input', function() {
        if (this.value && this.value.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters long';
        } else {
            passwordError.textContent = '';
        }
    });
});