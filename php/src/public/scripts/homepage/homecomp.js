function resetListeners() {
    document.querySelectorAll(".fa-trash-alt").forEach(function (element) {
      element.addEventListener("click", function () {
        var lowonganId = this.getAttribute("data-id");
    
        var confirmDelete = confirm(
          "Apakah Anda yakin ingin menghapus pekerjaan ini?"
        );
    
        if (confirmDelete) {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "/lowongan/deleteJob", true);
          xhr.setRequestHeader("Content-Type", "application/json");
    
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
              if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
    
                if (response.success) {
                  alert("Pekerjaan berhasil dihapus.");
                  window.location.reload();
                } else {
                  alert(
                    "Terjadi kesalahan saat menghapus pekerjaan: " +
                      response.message
                  );
                }
              } else {
                alert("Terjadi kesalahan jaringan atau server.");
              }
            }
          };
    
          var data = JSON.stringify({ low_id: lowonganId });
          xhr.send(data);
        }
      });
    });
    
    document.querySelectorAll(".fa-edit").forEach(function (element) {
      element.addEventListener("click", function () {
        var lowonganId = this.getAttribute("data-id");
        window.location.href = "/lowongan/toEditJob?id=" + lowonganId;
      });
    });
    
    const button = document.getElementById("add-job");
    
    button.addEventListener("click", function () {
      window.location.href = "/lowongan/toAddJob";
    });
    
}