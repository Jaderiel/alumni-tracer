let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 200)

let popup = document.getElementById('popup');

function openPopup() {
    // Check if the terms checkbox is checked
    var termsCheckbox = document.getElementById('termsCheckbox');
    if (!termsCheckbox.checked) {
        alert('Please agree to the Terms of Use and Privacy Policy');
        return;
    }

    // Show the popup and blur the background
    popup.classList.add('open-popup');
    container.classList.add('blur');
}

function closePopup() {
    popup.classList.remove('open-popup');
    container.classList.remove('blur');
}

// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> elements for Terms of Use and Privacy Policy
var termsLink = document.getElementById("termsLink");
var privacyLink = document.getElementById("privacyLink");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the "Terms of Use" span, open the modal
termsLink.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default action
    modal.style.display = "block";
});

// When the user clicks on the "Privacy Policy" span, open the modal
privacyLink.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default action
    modal.style.display = "block";
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

