const filterButtons = document.querySelectorAll("#filter-buttons button");
const filterableCards = document.querySelectorAll("#filterable-cards .card");

const filterCards = (e) => {
    document.querySelector("#filter-buttons .active").classList.remove("active");
    e.target.classList.add("active");

    filterableCards.forEach(card => {
       
        if(card.dataset.name === e.target.dataset.filter || e.target.dataset.filter === "all") {
            return card.classList.replace("hide", "show");
        }
        card.classList.add("hide");
    });
}

filterButtons.forEach(button => button.addEventListener("click", filterCards));

document.addEventListener('DOMContentLoaded', function () {
    const modalImage = document.getElementById('modalImage');
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const image = card.querySelector('img');
        const ellipsis = card.querySelector('.fa-ellipsis-v');
        
        image.addEventListener('click', function (event) {
            const imagePath = card.getAttribute('data-image');
            modalImage.src = imagePath;
        });

        ellipsis.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent event from bubbling up to parent elements
            // Implement the function to open the ellipsis menu here
            openPopup();
        });
    });
});

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