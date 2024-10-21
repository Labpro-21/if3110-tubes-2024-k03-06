document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete-lowongan").forEach(function (button) {
    button.addEventListener("click", function () {
      if (confirm("Are you sure you want to delete this job?")) {
        var lowonganId = this.getAttribute("data-id");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/lowongan/deleteJob", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
              alert("Job successfully deleted.");
              window.location.href = "/lowongan/list";
            } else {
              alert(
                "Terjadi kesalahan saat menghapus pekerjaan: " +
                  response.message
              );
            }
          } else if (xhr.readyState === 4) {
            alert("Terjadi kesalahan jaringan atau server.");
          }
        };

        var data = JSON.stringify({ low_id: lowonganId });
        xhr.send(data);
      }
    });
  });

  document.querySelectorAll(".close-lowongan").forEach(function (button) {
    button.addEventListener("click", function () {
      if (confirm("Apakah Anda yakin ingin menutup pekerjaan ini?")) {
        var lowonganId = this.getAttribute("data-id");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/lowongan/closeJob", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
              alert("Pekerjaan berhasil ditutup.");
              window.location.reload();
            } else {
              alert(
                "Terjadi kesalahan saat menutup pekerjaan: " + response.message
              );
            }
          } else if (xhr.readyState === 4) {
            alert("Terjadi kesalahan jaringan atau server.");
          }
        };

        var data = JSON.stringify({ low_id: lowonganId });
        xhr.send(data);
      }
    });
  });

  document.querySelectorAll(".open-lowongan").forEach(function (button) {
    button.addEventListener("click", function () {
      if (confirm("Apakah Anda yakin ingin membuka pekerjaan ini?")) {
        var lowonganId = this.getAttribute("data-id");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/lowongan/openJob", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
              alert("Pekerjaan berhasil dibuka.");
              window.location.reload();
            } else {
              alert(
                "Terjadi kesalahan saat membuka pekerjaan: " + response.message
              );
            }
          } else if (xhr.readyState === 4) {
            alert("Terjadi kesalahan jaringan atau server.");
          }
        };

        var data = JSON.stringify({ low_id: lowonganId });
        xhr.send(data);
      }
    });
  });
});
