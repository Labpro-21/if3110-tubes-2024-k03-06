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
        fetch("/upload", {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = "/lowongan?id=" + data.id;
            } else {
                showError(data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            showError("Terjadi kesalahan saat mengunggah data.");
        });
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
