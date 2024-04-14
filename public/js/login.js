let container = document.getElementById('container')

toggle = () => {
	container.classList.toggle('sign-in')
	container.classList.toggle('sign-up')
}

setTimeout(() => {
	container.classList.add('sign-in')
}, 200)

let popup = document.getElementById('popup')

function openPopup() {
    popup.classList.add('open-popup');
    container.classList.add('blur');
}

function closePopup() {
    popup.classList.remove('open-popup');
    container.classList.remove('blur');
}

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

