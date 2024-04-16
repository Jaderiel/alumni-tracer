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

function openPopup0() {
    popup0.classList.add('open-popup0');
    container.classList.add('opacity');
}

function closePopup0() {
    popup0.classList.remove('open-popup0');
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

function openPopup3() {
    popup3.classList.add('open-popup3');
    container.classList.add('opacity');
}

function closePopup3() {
    popup3.classList.remove('open-popup3');
    container.classList.remove('opacity');
}

function openPopup4() {
    popup4.classList.add('open-popup4');
    container.classList.add('opacity');
}

function closePopup4() {
    popup4.classList.remove('open-popup4');
    container.classList.remove('opacity');
}

let popup = document.getElementById('popup-del');
let interface = document.getElementById('interface');
let menu = document.getElementById('menu');

function deletePopup() {
    popup.classList.add('delete-popup');
    interface.classList.add('blur');
    menu.classList.add('blur'); 
    popup4.classList.add('blur'); 
}

function closePopup() {
    popup.classList.remove('delete-popup');
    interface.classList.remove('blur');
    menu.classList.remove('blur'); 
    popup4.classList.remove('blur'); 
}

function openPopup() {
    popup.style.display = "block";
}


document.addEventListener("DOMContentLoaded", function() {
    var thumbsUpContainers = document.querySelectorAll('.forum-section2');

    thumbsUpContainers.forEach(function(container) {
        container.addEventListener('click', function(event) {
            // Check if the clicked element has the class comment-button
            if (!event.target.closest('.comment-button')) {
                var thumbsUpIcon = this.querySelector('.fa-thumbs-up');

                if (thumbsUpIcon.style.color === 'rgb(34, 139, 230)') {
                    thumbsUpIcon.style.color = ''; 
                } else {
                    thumbsUpIcon.style.color = '#228BE6'; 
                }
            }
            
            event.stopPropagation();
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var likersContainers = document.querySelectorAll('.likers');
    
    likersContainers.forEach(function(container) {
        container.addEventListener('click', function(event) {
            openPopup3();
            
            event.stopPropagation();
        });
    });
});

function toggleEdit() {
    var comment = document.getElementById("editableComment");
    var editButton = document.getElementById("taym");
    if (comment.contentEditable === "true") {
        comment.contentEditable = "false";
        editButton.innerText = "Edit";
    } else {
        comment.contentEditable = "true";
        editButton.innerText = "Save";
    }
    comment.focus();
}

function toggleEdit2() {
    var comment = document.getElementById("editableComment2");
    var editButton = document.getElementById("taym2");
    if (comment.contentEditable === "true") {
        comment.contentEditable = "false";
        editButton.innerText = "Edit";
    } else {
        comment.contentEditable = "true";
        editButton.innerText = "Save";
    }
    comment.focus();
}

function toggleEdit3() {
    var comment = document.getElementById("editableComment3");
    var editButton = document.getElementById("taym3");
    if (comment.contentEditable === "true") {
        comment.contentEditable = "false";
        editButton.innerText = "Edit";
    } else {
        comment.contentEditable = "true";
        editButton.innerText = "Save";
    }
    comment.focus();
}

function clearFields() {
    // Select all input fields, text areas, etc.
    var inputFields = document.querySelectorAll('input, textarea');

    // Loop through each input field and reset its value to an empty string
    inputFields.forEach(function(field) {
        field.value = '';
    });
}

// Add an event listener to the clear button
document.getElementById('clearButton').addEventListener('click', clearFields);
