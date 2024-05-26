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

    document.getElementById('profile-name2').textContent = name;
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

function openPopup3(postId) {
    console.log("Post ID:", postId);
    document.getElementById('postID').textContent = "Post ID: " + postId;
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

// document.addEventListener("DOMContentLoaded", function() {
//     var likersContainers = document.querySelectorAll('.likers');
    
//     likersContainers.forEach(function(container) {
//         container.addEventListener('click', function(event) {
//             openPopup3();
            
//             event.stopPropagation();
//         });
//     });
// });

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
// Add an event listener to the SAVE button
document.getElementById('update-post-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    
    // Gather the updated caption value from the textarea
    var caption = document.getElementById('edited_caption').value;
    
    // Gather the updated media file from the input field
    var mediaFile = document.getElementById('edited_media').files[0];
    
    // Construct a FormData object to send both the caption and the media file
    var formData = new FormData();
    formData.append('edited_caption', caption);
    formData.append('edited_media', mediaFile);
    
    // Send a PUT request to update the post
    fetch('/update-post/{{ $post->id }}', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
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
        closeEditPopup();
    })
    .catch(error => {
        console.error('Error updating post:', error);
        // Optionally, display an error message to the user
    });
});

// Function to update the media preview when a file is selected
document.getElementById('edited_media').addEventListener('change', function(event) {
    var mediaFile = event.target.files[0];
    var mediaPreview = document.getElementById('media-preview');

    // Update the image preview
    if (mediaFile) {
        var reader = new FileReader();
        reader.onload = function(e) {
            mediaPreview.src = e.target.result;
        };
        reader.readAsDataURL(mediaFile);
    }
});

// Open edit popup
function openEditPopup(postId, caption, media) {
    console.log("Post ID:", postId);
    // Set the post ID and caption in the edit form
    document.getElementById('post_id').value = postId;
    document.getElementById('edited_caption').value = caption;

    // Update the media preview image
    var mediaPreview = document.getElementById('media-preview');
    
    // Make a request to fetch the media associated with the postId
    fetch(`/update-post/${postId}`) // Replace '/get-media' with your actual endpoint to fetch media
        .then(response => response.json())
        .then(data => {
            // Assuming data contains the URL of the media
            mediaPreview.src = data.mediaUrl; // Update the src attribute with the media URL
        })
        .catch(error => {
            console.error('Error fetching media:', error);
        });
    
    // Show the edit popup
    document.getElementById('edit-popup').style.display = "block";

    // Set the delete form action with the correct post ID
    document.getElementById('delete-post-form').action = "/delete-post/" + postId;
}


// Close edit popup
function closeEditPopup() {
    document.getElementById('edit-popup').style.display = "none";
}
