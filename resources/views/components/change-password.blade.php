<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name-user">
            <a href="{{ route('profile.edit') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>
            Change Password
        </h3>

        <form action="{{ route('update.password') }}" method="POST" oninput="validatePassword()">
    {{ csrf_field() }}
    @method('PUT')
    <div class="create-account-holder">
        <div class="flex flex-col gap-4 my-10 justify-center items-center">
            <div>
                
                @if (session('success'))
                    <span class="text-customGreen text-xs">{{ session('success') }}</span>
                @endif
            </div>
            <div>
    <label class="form-label" for="current_password">Enter Current Password</label>
    <input type="password" class="pass" name="current_password" id="current_password" required oninput="validatePassword()">
    <span id="current_password_error" class="show-error"></span>
    @error('current_password')
        <span class="show-error">{{ $message }}</span>
    @enderror
</div>

            <div>
                <label class="form-label" for="new_password">Enter New Password</label>
                <input type="password" class="pass" name="new_password" id="new_password" required>
                <span id="new_password_error" class="show-error"></span>
            </div>

            <div>
                <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                <input type="password" class="pass" name="new_password_confirmation" id="new_password_confirmation" required>
                <span id="confirm_password_error" class="show-error"></span>
            </div>

            <div>
                <button type="submit" class="bg-customGreen text-white text-xs hover:bg-customTextBlue hover:text-black py-2 px-4" style="border-radius: 3px; margin-bottom: 20px">Change password</button>
            </div>
        </div>
    </div>
</form>
    </section>

</body>
</html>

<script>
    function validatePassword() {
        var currentPassword = document.getElementById('current_password').value;
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('new_password_confirmation').value;

        // Check if current password is empty
        if (currentPassword.length === 0) {
            document.getElementById('current_password_error').innerText = 'Current password is required.';
        } else {
            document.getElementById('current_password_error').innerText = '';
        }

        // Check if new password meets length requirement
        if (newPassword.length > 0 && newPassword.length < 6) {
            document.getElementById('new_password_error').innerText = 'It should be at least 6 characters.';
        } else {
            document.getElementById('new_password_error').innerText = '';
        }

        // Check if new password and confirmation match
        if (newPassword.length > 0 && confirmPassword.length > 0 && newPassword !== confirmPassword) {
            document.getElementById('confirm_password_error').innerText = 'New password does not match.';
        } else {
            document.getElementById('confirm_password_error').innerText = '';
        }
    }
</script>

<style>
    .back-link {
        margin-top: 20px;
        margin-right: 10px;
        background-color: #FFFFFF;
        color: #2974A7;
        text-decoration: none;
        padding: 5px 13px;
        border-radius: 6px;
        border: 1px solid #2974A7;
        font-size: 13px;
    }

    .back-link:hover {
        background-color: #a6d0ec;
    }

    .create-account-holder {
        background-color: white;
        padding: 3px 30px;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 330px; 
        margin: 0 auto;
        margin-top: 30px;
    }

    .form-label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
        font-size: 13px;
    }

    .pass {
        width: 100%;
        border: 1px solid #2974A7;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 5px;
    }

    input:focus {
        outline: none;
        border: 2px solid #ADBCF2;
    }

    .error {
    border: 1px solid red;
}
    .show-error {
        color: red;
    font-size: .7rem;
    }

    .input-error {
    border-color: red;
}
</style>
