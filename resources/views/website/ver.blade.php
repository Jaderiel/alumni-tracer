<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="flex items-center justify-center min-h-screen" style="background-color: #162F65;">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-md mb-4" style="text-align:center; font-weight:600">Please verify your email to notify the admin about your registration and kindly check your email for the verification code. Thank you! </p>

        <form action="{{ route('email.verify') }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="verification_code" class="block text-gray-700">Verification Code:</label>
                <input type="text" name="verification_code" required class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Verify</button>
        </form>

        <p class="text-sm mb-4">Didn't receive email verification?</p>
        <form action="{{ route('resend.verification.code') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="resend_email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">Resend Verification Code</button>
        </form>

        <a href="{{ route('login.show') }}" class="block text-center mt-4 text-blue-500 hover:text-blue-700">Back to Login</a>
    </div>
</body>
</html>
