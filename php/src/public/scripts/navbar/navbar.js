document.addEventListener("DOMContentLoaded", function() {
    const profileNav = document.getElementById("profile-nav");
    if (profileNav) {
        const dropdownMenu = profileNav.querySelector(".dropdown-menu");

        // Event listener untuk mengklik gambar
        profileNav.addEventListener("click", function(event) {
            // Toggle dropdown visibility
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            event.stopPropagation(); // Stop click propagation
        });

        // Hide dropdown if clicked outside
        document.addEventListener("click", function() {
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            }
        });
    }
});
