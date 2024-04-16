let popup = document.getElementById('popup');
let interface = document.getElementById('interface');
let menu = document.getElementById('menu');

function openPopup() {
    popup.classList.add('open-popup');
    interface.classList.add('blur');
    menu.classList.add('blur'); // Apply blur to the menu
}

function closePopup() {
    popup.classList.remove('open-popup');
    interface.classList.remove('blur');
    menu.classList.remove('blur'); // Remove blur from the menu
}

document.addEventListener("DOMContentLoaded", function() {
    // Toggle dropdown when the bell icon is clicked
    document.getElementById("notification-btn").addEventListener("click", function() {
        var dropdown = document.querySelector(".notification-dropdown");
        dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    });

    // Hide dropdown when clicking outside of it
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