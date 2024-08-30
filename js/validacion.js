document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmar_password");
  const nombreInput = document.querySelector("input[name='nombre']");
  const apellidoInput = document.querySelector("input[name='apellido']");
  const cedulaInput = document.querySelector("input[name='cedula']");
  const emailInput = document.querySelector("input[name='email']");

  function validatePassword() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    const hasLowercase = /[a-z]/.test(password);
    const hasUppercase = /[A-Z]/.test(password);
    const hasMinLength = password.length >= 8;

    if (password !== confirmPassword) {
      setErrorMessage(confirmPasswordInput, "Las contraseñas no coinciden", true);
    } else {
      setErrorMessage(confirmPasswordInput, "");
    }

    if (!hasLowercase || !hasUppercase || !hasMinLength) {
      setErrorMessage(passwordInput, "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y una letra minúscula", true);
    } else {
      setErrorMessage(passwordInput, "");
    }
  }


  function validateField(input, regex, errorMessage) {
    const value = input.value;
    if (!regex.test(value)) {
      setErrorMessage(input, errorMessage, true);
    } else {
      setErrorMessage(input, "");
    }
  }

  function setErrorMessage(input, message, showError = false) {
    const errorElement = input.nextElementSibling;
    errorElement.textContent = message;
    errorElement.style.display = showError ? "block" : "none";
  }

  form.addEventListener("input", function (event) {
    const target = event.target;

    if (target === passwordInput || target === confirmPasswordInput) {
      validatePassword();
    } else if (target === nombreInput) {
      validateField(target, /^[A-Za-zÁ-Úá-ú\s]+$/, "Formato de nombre incorrecto (solo letras y espacios)");
    } else if (target === apellidoInput) {
      validateField(target, /^[A-Za-zÁ-Úá-ú\s]+$/, "Formato de apellido incorrecto (solo letras y espacios)");
    } else if (target === cedulaInput) {
      validateField(target, /^[0-9]{10}$/, "La cédula debe tener 10 dígitos numéricos");
    } else if (target === emailInput) {
      validateField(target, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Formato de correo electrónico incorrecto");
    }
  });

  passwordInput.addEventListener("input", function () {
    validatePassword();
  });

  form.addEventListener("submit", function () {
    validatePassword();
    validateField(nombreInput, /^[A-Za-zÁ-Úá-ú\s]+$/, "Formato de nombre incorrecto (solo letras y espacios)");
    validateField(apellidoInput, /^[A-Za-zÁ-Úá-ú\s]+$/, "Formato de apellido incorrecto (solo letras y espacios)");
    validateField(cedulaInput, /^[0-9]{10}$/, "La cédula debe tener 10 dígitos numéricos");
    validateField(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Formato de correo electrónico incorrecto");
  });
});
