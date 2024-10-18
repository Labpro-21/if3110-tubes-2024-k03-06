document.addEventListener('DOMContentLoaded', function() {
    const form = this.getElementById('login-form');

    form.addEventListener('submit', function(e) {
        clearErrors();

        let emailValid = validateEmail();
        console.log(emailValid);

        if (!emailValid) {e.preventDefault()} else {
            let passwordValid = validatePassword();
            if (!passwordValid) {e.preventDefault();}
        }
    });
});

function validateEmail() {
    const email = document.getElementById('email').value;
    const emailError = document.getElementById('nameError');
    const emailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email.trim().length == 0) {
      emailError.textContent = 'Email is required.';
      document.getElementById('email').classList.add('invalid');
      return false;
    } else if (!emailPattern.test(email)) {
      emailError.textContent = 'Invalid email format.';
      document.getElementById('email').classList.add('invalid');
      return false;
    }

    return true;
  }

  function validatePassword() {
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('passwordError');

    if (password.trim().length == 0) {
      passwordError.textContent = 'Password is required.';
      document.getElementById('password').classList.add('invalid');
      return false;
    } else if (password.length < 6) {
      passwordError.textContent = 'Password must be at least 6 characters.';
      document.getElementById('password').classList.add('invalid');
      return false;
    }

    return true;
  }

  function clearErrors() {
    const errorMessages = document.querySelectorAll('.error');
    const invalidFields = document.querySelectorAll('.invalid');

    errorMessages.forEach(error => error.textContent = '');
    invalidFields.forEach(field => field.classList.remove('invalid'));
  }