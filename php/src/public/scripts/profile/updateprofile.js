document.addEventListener('DOMContentLoaded', function(){
    // Initialize the Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    var form = document.getElementById('update-form');
    form.onsubmit = function (event) {
        // Clear any previous error messages
        document.getElementById('nameError').textContent = '';
        document.getElementById('locError').textContent = '';
        document.getElementById('descError').textContent = '';

        // Get form field values
        var companyName = document.getElementById('company-title').value.trim();
        var companyLocation = document.getElementById('company-loc').value.trim();
        var aboutContent = quill.root.innerHTML.trim(); // Get HTML content from the Quill editor

        var isValid = true;

        if (companyName === "" || companyName.length < 3) {
            document.getElementById('nameError').textContent = "Company Name must be at least 3 characters.";
            isValid = false;
        }

        if (companyLocation === "") {
            document.getElementById('locError').textContent = "Company Location is required.";
            isValid = false;
        }

        if (aboutContent === "<p><br></p>" || aboutContent === "") {
            document.getElementById('descError').textContent = "Company About cannot be empty.";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
            return false;
        }

        document.querySelector('#company-desc').value = aboutContent;
    };
})