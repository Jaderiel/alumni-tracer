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

function openPopup() {
    popup.classList.add('open-popup');
    container.classList.add('opacity');
}

function closePopup() {
    popup.classList.remove('open-popup');
    container.classList.remove('opacity');
}

function openPopup2() {
    popup2.classList.add('open-popup2');
    container.classList.add('opacity');
}

function closePopup2() {
    popup2.classList.remove('open-popup2');
    container.classList.remove('opacity');
}

