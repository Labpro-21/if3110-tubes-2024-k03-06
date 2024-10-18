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
        let role = roleInput.value;

        this.querySelectorAll('input, textarea').forEach(input => {
            if (!(role == "job_seeker" && (input.name == "location" || input.name == "about"))) {
                validateField({ target: input });
            }
        });

        let invalidField = this.querySelector('.invalid');

        if (invalidField) {
            alert("Please correct the errors in the form before submitting.");
            event.preventDefault();
        }
    });
})

function hasInput(inputContent) {
    return inputContent.length > 0;
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

// document.getElementById('jobSeekerForm').addEventListener('submit', function(event) {
//     event.preventDefault(); // Prevent page reload

//     let name = document.getElementById('js-name').value;
//     let email = document.getElementById('js-email').value;
//     let password = document.getElementById('js-password').value;
//     let confirmPassword = document.getElementById('js-confirm-password').value;
//     let errorDiv = document.getElementById('js-error');

//     // Basic validation
//     if (password !== confirmPassword) {
//         errorDiv.textContent = "Passwords do not match!";
//         return;
//         alert("passwword salah");
//     } else {
//         alert("berhasil login");
//     }

//     // Clear errors
//     errorDiv.textContent = "";

//     // Prepare data for AJAX request
//     let formData = new FormData();
//     formData.append('name', name);
//     formData.append('email', email);
//     formData.append('password', password);
//     formData.append('role', 'job_seeker');

//     // AJAX request
//     fetch('../../controllers/RegisterController.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             window.location.href = 'home_jobseeker.php'; // Redirect on success
//         } else {
//             errorDiv.textContent = data.message; // Show error message
//         }
//     })
//     .catch(error => {
//         errorDiv.textContent = "Error occurred. Try again.";
//     });
// });

// // Similar form submission for Company form
// document.getElementById('companyForm').addEventListener('submit', function(event) {
//     event.preventDefault(); // Prevent page reload

//     let companyName = document.getElementById('co-name').value;
//     let email = document.getElementById('co-email').value;
//     let password = document.getElementById('co-password').value;
//     let confirmPassword = document.getElementById('co-confirm-password').value;
//     let location = document.getElementById('location').value;
//     let about = document.getElementById('about').value;
//     let errorDiv = document.getElementById('co-error');

//     // Basic validation
//     if (password !== confirmPassword) {
//         errorDiv.textContent = "Passwords do not match!";
//         return;
//     }

//     // Clear errors
//     errorDiv.textContent = "";

//     // Prepare data for AJAX request
//     let formData = new FormData();
//     formData.append('name', companyName);
//     formData.append('email', email);
//     formData.append('password', password);
//     formData.append('location', location);
//     formData.append('about', about);
//     formData.append('role', 'company');

//     // AJAX request
//     fetch('../../controllers/RegisterController.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             window.location.href = 'home_company.php'; // Redirect on success
//         } else {
//             errorDiv.textContent = data.message; // Show error message
//         }
//     })
//     .catch(error => {
//         errorDiv.textContent = "Error occurred. Try again.";
//     });
// });