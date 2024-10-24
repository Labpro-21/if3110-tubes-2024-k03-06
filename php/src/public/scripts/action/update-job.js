document.addEventListener("DOMContentLoaded", function () {
  var quill = new Quill("#editor", {
    theme: "snow",
  });

  const form = document.getElementById("update-job-form");
  form.addEventListener("submit", function () {
    var description = document.querySelector('input[name="job-description"]');
    description.value = quill.root.innerHTML;
  });
});
