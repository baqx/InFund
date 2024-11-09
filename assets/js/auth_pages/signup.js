document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmPassword");
  const togglePasswordButtons = document.querySelectorAll(".toggle-password");

  // Configure toastr
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "5000",
  };

  // Toggle password visibility
  togglePasswordButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const input = this.previousElementSibling;
      const type =
        input.getAttribute("type") === "password" ? "text" : "password";
      input.setAttribute("type", type);
      this.querySelector("i").classList.toggle("fa-eye");
      this.querySelector("i").classList.toggle("fa-eye-slash");
    });
  });

  // Real-time validation
  const inputs = form.querySelectorAll("input[required], select[required]");
  inputs.forEach((input) => {
    input.addEventListener("input", function () {
      validateField(this);
    });

    input.addEventListener("blur", function () {
      validateField(this);
    });
  });

  // Form submission
  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    let isValid = true;
    inputs.forEach((input) => {
      if (!validateField(input)) {
        isValid = false;
      }
    });

    if (isValid) {
      const submitButton = form.querySelector(".submit-button");
      submitButton.disabled = true;
      submitButton.value = "Creating Account...";

      try {
        const formData = new FormData(form);
        const response = await fetch("register.php", {
          method: "POST",
          body: formData,
        });

        const result = await response.json();

        if (result.status === "success") {
          toastr.success(result.message);
          // Optional: Redirect after successful registration
          setTimeout(() => {
            window.location.href = "./login";
          }, 2000);
        } else {
          // Handle validation errors
          if (result.errors) {
            Object.entries(result.errors).forEach(([field, message]) => {
              const errorElement = document.getElementById(`${field}Error`);
              if (errorElement) {
                errorElement.textContent = message;
              }
              toastr.error(message);
            });
          } else {
            toastr.error(result.message || "Registration failed");
          }
        }
      } catch (error) {
        toastr.error("An error occurred. Please try again later.");
      } finally {
        submitButton.disabled = false;
        submitButton.value = "Create Account";
      }
    }
  });

  // Form submission
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;
    inputs.forEach((input) => {
      if (!validateField(input)) {
        isValid = false;
      }
    });

    if (isValid) {
      // Here you would typically submit the form to your PHP endpoint
      console.log("Form is valid, ready to submit");
      // form.submit();
    }
  });

  // Validation functions
  function validateField(field) {
    const errorElement = document.getElementById(`${field.id}Error`);
    let isValid = true;
    let errorMessage = "";

    // Remove previous validation classes
    field.classList.remove("is-valid", "is-invalid");

    // Basic required field validation
    if (!field.value.trim()) {
      errorMessage = "This field is required";
      isValid = false;
    } else {
      // Specific field validations
      switch (field.id) {
        case "username":
          if (!/^[a-zA-Z0-9_]{3,20}$/.test(field.value)) {
            errorMessage =
              "Username must be 3-20 characters and can only contain letters, numbers, and underscores";
            isValid = false;
          }
          break;

        case "email":
          if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
            errorMessage = "Please enter a valid email address";
            isValid = false;
          }
          break;

        case "dob":
          const age = calculateAge(new Date(field.value));
          if (age < 16) {
            errorMessage = "You must be at least 16 years old to register";
            isValid = false;
          }
          break;

        case "matricno":
          if (!/^[A-Z0-9/]+$/.test(field.value)) {
            errorMessage = "Please enter a valid matriculation number";
            isValid = false;
          }
          break;

        case "password":
          if (field.value.length < 8) {
            errorMessage = "Password must be at least 8 characters long";
            isValid = false;
          } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(field.value)) {
            errorMessage =
              "Password must contain at least one uppercase letter, one lowercase letter, and one number";
            isValid = false;
          }
          updatePasswordStrength(field.value);
          break;

        case "confirmPassword":
          if (field.value !== passwordInput.value) {
            errorMessage = "Passwords do not match";
            isValid = false;
          }
          break;
      }
    }

    // Update UI with validation result
    if (isValid) {
      field.classList.add("is-valid");
      errorElement.textContent = "";
    } else {
      field.classList.add("is-invalid");
      errorElement.textContent = errorMessage;
    }

    return isValid;
  }

  // Helper functions
  function calculateAge(birthDate) {
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (
      monthDiff < 0 ||
      (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
      age--;
    }
    return age;
  }

  function updatePasswordStrength(password) {
    const strengthBar = document.querySelector(".password-strength-bar");
    let strength = 0;

    // Length check
    if (password.length >= 8) strength += 1;

    // Character variety checks
    if (/[A-Z]/.test(password)) strength += 1;
    if (/[a-z]/.test(password)) strength += 1;
    if (/[0-9]/.test(password)) strength += 1;
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;

    // Update strength indicator
    strengthBar.className = "password-strength-bar";
    if (strength <= 2) {
      strengthBar.classList.add("strength-weak");
    } else if (strength <= 3) {
      strengthBar.classList.add("strength-medium");
    } else {
      strengthBar.classList.add("strength-strong");
    }
  }
});
