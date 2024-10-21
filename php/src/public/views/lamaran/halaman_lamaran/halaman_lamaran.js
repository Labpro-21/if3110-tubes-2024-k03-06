document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("lamar-process");
    const cvInput = document.getElementById("cv-upload");
    const videoInput = document.getElementById("video-upload");
    const errorField = document.getElementById("lamarError");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); 
        errorField.textContent = ""; 

        if (!validateCV()) return;
        if (!validateVideo()) return;

        handleSubmit(form);
    });

    function validateCV() {
        if (cvInput.files.length === 0) {
            showError("CV wajib diunggah.");
            cvInput.classList.add("error-border");
            return false;
        }

        // Cek format file
        const cvFile = cvInput.files[0];
        const cvFileType = cvFile.name.split(".").pop().toLowerCase();
        if (cvFileType !== "pdf") {
            showError("Maaf, hanya file PDF yang diperbolehkan untuk CV.");
            cvInput.classList.add("error-border");
            return false;
        }

        cvInput.classList.remove("error-border");
        return true;
    }

    function validateVideo() {
        if (videoInput.files.length > 0) {
            const videoFile = videoInput.files[0];
            const videoFileType = videoFile.name.split(".").pop().toLowerCase();

            // Cek format file 
            if (videoFileType !== "mp4") {
                showError("Maaf, hanya file MP4 yang diperbolehkan untuk video.");
                videoInput.classList.add("error-border");
                return false;
            }

            videoInput.classList.remove("error-border");
        }
        return true;
    }

    function showError(message) {
        errorField.textContent = message;
    }

    function handleSubmit(form) {
        const formData = new FormData(form);
        
        const xhr = new XMLHttpRequest();
    
        xhr.open("POST", "/lamar/lamarlowongan", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        if (data.success) {
                            window.location.href = "/lowongan?id=" + data.id;
                        } else {
                            showError(data.message);
                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        console.log(xhr.responseText);
                        showError("Terjadi kesalahan saat memproses respons dari server.");
                    }
                } else {
                    showError("Terjadi kesalahan saat mengunggah data.");
                }
            }
        };
    
        xhr.send(formData);
    }
    

    // Reset error
    cvInput.addEventListener("change", function () {
        cvInput.classList.remove("error-border");
        errorField.textContent = "";
    });

    videoInput.addEventListener("change", function () {
        videoInput.classList.remove("error-border");
        errorField.textContent = "";
    });
});
