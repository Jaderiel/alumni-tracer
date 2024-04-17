document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("notification-btn").addEventListener("click", function() {
        var dropdown = document.querySelector(".notification-dropdown");
        dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    });

    document.addEventListener("click", function(event) {
        var dropdown = document.querySelector(".notification-dropdown");
        var target = event.target;
        var isClickInsideDropdown = dropdown.contains(target);
        var isNotificationIcon = target === document.getElementById("notification-btn");

        if (!isClickInsideDropdown && !isNotificationIcon) {
            dropdown.style.display = "none";
        }
    });
});