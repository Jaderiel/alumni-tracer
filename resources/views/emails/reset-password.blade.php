<!-- resources/views/auth/reset-password.blade.php -->

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Hidden input field to include the token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email field (optional) -->
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
    </div>

    <!-- Password field -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <!-- Confirm Password field -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">
        Reset Password
    </button>
</form>
