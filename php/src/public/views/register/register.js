document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('reg-form');
    const roleInput = document.getElementById('role');
    const roleInputError = document.getElementById('roleError');

    roleInput.addEventListener('change', function() {
        let role = this.value;
    
        document.getElementById('companyAdditionalForm').classList.add('hidden');

        this.classList.remove('invalid');
        roleInputError.textContent = "";

        if (role === 'company') {
            document.getElementById('companyAdditionalForm').classList.remove('hidden');
        }
    });

    form.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('blur', validateField);
    });

    form.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', function() {
            const errorElement = document.getElementById(this.id + 'Error');

            if (errorElement) {
                input.classList.remove('invalid');
                errorElement.textContent = "";
            }
        });
    });

    form.addEventListener('submit', function(event){
        event.preventDefault();

        let role = roleInput.value;
        this.querySelectorAll('select, input, textarea').forEach(input => {
            if (!input.closest('.hidden')) {
                validateField({ target: input });
            }
        });

        if (this.querySelector('.invalid')) {
            alert("Please correct the errors in the form before submitting.");
            return;
        }

        const formData = new FormData(this);

        fetch('/register/register', {
            method : 'POST',
            body : formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/home';
            } else {
                document.getElementById('emailError').textContent = data.message;
                document.getElementById('email').classList.add('invalid');
            }
        })
        .catch(error => console.error('Error:', error));
    });
})

function hasInput(inputContent) {
    return inputContent.trim().length > 0;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function validateField(e) {
    const field = e.target;

    const errorElement = document.getElementById(`${field.id}Error`);

    if (!hasInput(field.value)) {
        if (field.name == "repeatPassword") {
            errorElement.textContent = `The 'Confirm password' field cannot be empty!`;
        } else if (field.name == "role") {
            errorElement.textContent = 'Please select the role you want to register!';
        } else {
            errorElement.textContent = `The '${capitalizeFirstLetter(field.name)}' field cannot be empty!`;
        }
        field.classList.add('invalid');

    } else if (field.id === 'email' && !validateEmail(field.value)) {
        errorElement.textContent = 'Please enter a valid email!';
        field.classList.add('invalid');
    } else if ((field.id === 'password' || field.id === 'repeatPassword') && !validatePassword(field.value)) {
        errorElement.textContent = 'Password must be 8-20 characters!';
        field.classList.add('invalid');
    } else {
        errorElement.textContent = '';
        field.classList.remove('invalid');
    }

    if (field.id === 'password'|| field.id === 'repeatPassword') {
        let password = document.getElementById('password').value;
        let repassword = document.getElementById('repeatPassword');

        if (hasInput(password) && hasInput(repassword.value) && repassword.value != password) {
            document.getElementById('repeatPasswordError').textContent = 'Password do not match!';
            repassword.classList.add('invalid');
        }
    }
}

function validatePassword(password) {
    return password.length >= 8 && password.length <= 20;
}

function validateEmail(email) {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
}