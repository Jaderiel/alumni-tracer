<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('email.verify') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="verification_code">Verification Code:</label>
        <input type="text" name="verification_code" required>
        <button type="submit">Verify</button>
    </form>

    <form action="{{ route('resend.verification.code') }}" method="POST">
        @csrf
        <label for="resend_email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Resend Verification Code</button>
    </form>
</body>
</html>
