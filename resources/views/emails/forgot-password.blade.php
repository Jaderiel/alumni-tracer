<form method="POST" action="{{ route('password.email') }}">
    @csrf

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @error('email')
        <div>{{ $message }}</div>
    @enderror

    <label for="email">Email</label>
    <input id="email" type="email" name="email" required autofocus>

    <button type="submit">Send Password Reset Link</button>
</form>
