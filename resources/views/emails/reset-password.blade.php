<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-customYellow {
            background-color: #e8c766; /* Custom yellow color */
        }
        .bg-customBlue {
            background-color: #162f65; /* Custom blue background color */
        }
    </style>
</head>
<body class="bg-customBlue flex items-center justify-center min-h-screen">

    <form method="POST" action="{{ route('password.update') }}" class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        @csrf

        <!-- Hidden input field to include the token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email field -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if ($errors->has('email'))
                <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Password field -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input id="password" type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if ($errors->has('password'))
                <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Confirm Password field -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if ($errors->has('password_confirmation'))
                <span class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-customYellow hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Reset Password
            </button>
        </div>
    </form>

</body>
</html>
