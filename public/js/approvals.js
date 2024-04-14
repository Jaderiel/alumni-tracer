
    function disableButton(userId) {
        console.log('Button clicked for user ID:', userId);
        // Disable the button after clicking
        var button = document.getElementById('approveBtn_' + userId);
        if (button) {
            button.disabled = true;
        } else {
            console.error('Button not found');
        }
    }

