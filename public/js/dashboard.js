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

function openPopup2(postId, name, caption, profilePic, media, course) {
    // Set the action attribute of the form
    var form = document.getElementById('update-post-form');
    form.action = "{{ route('dashboard.update', ['id' => '']) }}" + postId;

    // Set user details in the popup
    document.getElementById('profile-name2').textContent = name;
    document.getElementById('caption').textContent = caption;
    document.getElementById('profile-pic').src = profilePic ? profilePic : 'https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg';
    var mediaElement = document.getElementById('media-url');
    mediaElement.src = media;
    // Hide the profile picture if profilePic is empty
    mediaElement.style.display = media ? 'block' : 'none';
    document.getElementById('course').textContent = course;

    // Add classes or perform other actions as needed
    popup2.classList.add('open-popup2');
    container.classList.add('opacity');
    console.log("Clicked on ellipsis icon for post ID: " + postId + ", Name: " + name + ", Caption: " + caption );
}



function closePopup2(postId, name, caption, profilePic, media, course) {
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

// Add an event listener to the SAVE button
document.getElementById('update-post-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    
    // Gather the updated caption value from the textarea
    var caption = document.getElementById('caption').value;
    
    // Construct the data object to be sent in the request
    var data = {
        caption: caption
    };
    
    // Send a PUT request to update the post
    fetch('/update-post/{{ $post->id }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to update post');
        }
        return response.json();
    })
    .then(data => {
        console.log('Post updated successfully:', data);
        // Optionally, close the popup or perform other actions
        closePopup2();
    })
    .catch(error => {
        console.error('Error updating post:', error);
        // Optionally, display an error message to the user
    });
});

