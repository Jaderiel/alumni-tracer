let popup = document.getElementById('popup');
let interface = document.getElementById('interface');
let menu = document.getElementById('menu');

function deletePopup() {
    popup.classList.add('delete-popup');
    interface.classList.add('blur');
    menu.classList.add('blur'); // Apply blur to the menu
}

function closePopup() {
    popup.classList.remove('delete-popup');
    interface.classList.remove('blur');
    menu.classList.remove('blur'); // Remove blur from the menu
}