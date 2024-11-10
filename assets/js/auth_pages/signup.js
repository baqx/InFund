document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("registrationForm");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmPassword");
  const togglePasswordButtons = document.querySelectorAll(".toggle-password");

  // Configure toastr
  toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      timeOut: "5000"
  };

  // Toggle password visibility
  togglePasswordButtons.forEach(button => {
      button.addEventListener("click", function() {
          const input = this.previousElementSibling;
          const type = input.getAttribute("type") === "password" ? "text" : "password";
          input.setAttribute("type", type);
          this.querySelector("i").classList.toggle("fa-eye");
          this.querySelector("i").classList.toggle("fa-eye-slash");
      });
  });

  // Client-side validation
  form.addEventListener("submit", function(e) {
      let isValid = true;
      const username = document.getElementById("username").value;
      const email = document.getElementById("email").value;
      const password = passwordInput.value;
      const confirmPassword = confirmPasswordInput.value;

      // Username validation
      if (!/^[a-zA-Z0-9_]{3,20}$/.test(username)) {
          toastr.error("Username must be 3-20 characters and can only contain letters, numbers, and underscores");
          isValid = false;
      }

      // Email validation
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          toastr.error("Please enter a valid email address");
          isValid = false;
      }

      // Password validation
      if (password.length < 8) {
          toastr.error("Password must be at least 8 characters long");
          isValid = false;
      }

      if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
          toastr.error("Password must contain at least one uppercase letter, one lowercase letter, and one number");
          isValid = false;
      }

      if (password !== confirmPassword) {
          toastr.error("Passwords do not match");
          isValid = false;
      }

      if (!isValid) {
          e.preventDefault();
      }
  });
});