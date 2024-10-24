document.addEventListener("DOMContentLoaded", function () {
  var quill = new Quill("#editor", {
    theme: "snow",
  });

  const imageUpload = document.getElementById("job-image");
  const previewContainer = document.getElementById("preview");
  const jobTitle = document.getElementById("job-title");
  const jobType = document.getElementById("job-type");
  const jobLoc = document.getElementById("job-location");

  imageUpload.addEventListener("change", function (event) {
    const files = event.target.files;
    previewContainer.innerHTML = "";
    for (const file of files) {
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.onload = function (e) {
          const img = document.createElement("img");
          img.src = e.target.result;
          img.style.maxWidth = "200px";
          img.style.margin = "10px";
          previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
      } else {
        alert("File bukan gambar!");
      }
    }
  });

  const addButton = document.getElementById("add-button");
  addButton.addEventListener("click", function (event) {
    event.preventDefault();

    const userConfirmed = confirm("Are you sure you want to add this job?");

    if (userConfirmed) {
      const title = jobTitle.value;
      const description = quill.root.innerHTML;
      const files = imageUpload.files;
      const formData = new FormData();
      const type = jobType.value;
      const location = jobLoc.value;

      // Validasi Input
      if (title === "") {
        alert("Please enter a job title.");
        return;
      }

      if (description === "" || description === "<p><br></p>") {
        alert("Please enter a job description.");
        return;
      }

      if (type === "..." || location === "...") {
        alert("Please select a job type and location.");
        return;
      }

      formData.append("title", title);
      formData.append("description", description);
      formData.append("type", jobType.value);
      formData.append("location", jobLoc.value);
      for (let i = 0; i < files.length; i++) {
        formData.append("image[]", files[i]);
      }

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/lowongan/addJob", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          try {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
              window.location.href = "/home";
            } else {
                console.log(xhr.responseText);
              alert("Failed to add the job.");
            }
          } catch (error) {
            console.error("Error parsing JSON:", error);
            console.log(xhr.responseText);
            alert("An error occurred while processing your request.");
          }
        }
      };
      xhr.send(formData);
    } else {
      alert("Job addition canceled.");
    }
  });
});
