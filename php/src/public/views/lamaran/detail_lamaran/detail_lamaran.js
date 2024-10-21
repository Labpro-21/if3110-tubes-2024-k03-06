document.addEventListener("DOMContentLoaded", function () {
  const submitButton = document.querySelector(".submit-application");

  submitButton.addEventListener("click", function (event) {
    event.preventDefault();

    const userConfirmed = confirm(
      "Are you sure you want to finish reviewing the application?"
    );

    if (userConfirmed) {
      const status = document.getElementById("status").value;
      const message = document.getElementById("message").value;

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/lamar/review", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if ((xhr.readyState === 4) & (xhr.status === 200)) {
          try {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
              window.location.href = "/lowongan?id=" + response.id;
            } else {
              alert("Failed to finish reviewing the application.");
            }
          } catch (error) {
            console.error("Error parsing JSON:", error);
          }
        }
      };
      const data = `status=${encodeURIComponent(
        status
      )}&message=${encodeURIComponent(message)}`;
      xhr.send(data);
    } else {
      alert("Application review canceled.");
    }
  });
});
