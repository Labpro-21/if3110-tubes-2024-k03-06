document.addEventListener("DOMContentLoaded", function () {
  const form = this.getElementById("login-form");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    clearErrors();

    let emailValid = validateEmail();
    let passwordValid = validatePassword();

    if (emailValid && passwordValid) {
      const formData = new FormData(form);
      console.log(formData);

      fetch("/login/login", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.location.href = "/home";
          } else {
            document.getElementById("loginError").textContent = data.message;
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  });
});

function validateEmail() {
  const email = document.getElementById("email").value;
  const emailError = document.getElementById("nameError");
  const emailPattern =
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if (email.trim().length == 0) {
    emailError.textContent = "Email is required.";
    document.getElementById("email").classList.add("invalid");
    return false;
  } else if (!emailPattern.test(email)) {
    emailError.textContent = "Invalid email format.";
    document.getElementById("email").classList.add("invalid");
    return false;
  }

  return true;
}

function validatePassword() {
  const password = document.getElementById("password").value;
  const passwordError = document.getElementById("passwordError");

  if (password.trim().length == 0) {
    passwordError.textContent = "Password is required.";
    document.getElementById("password").classList.add("invalid");
    return false;
  } else if (password.length < 8 || password.length > 20) {
    passwordError.textContent = "Password must be 8-20 characters!";
    document.getElementById("password").classList.add("invalid");
    return false;
  }

  return true;
}

function clearErrors() {
  const errorMessages = document.querySelectorAll(".error");
  const invalidFields = document.querySelectorAll(".invalid");

  errorMessages.forEach((error) => (error.textContent = ""));
  invalidFields.forEach((field) => field.classList.remove("invalid"));
}
