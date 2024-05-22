<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Version</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="bg-customBlue font-Poppins">
    <div class="flex flex-col justify-center items-center">
        <div class="text-white text-4xl font-bold mt-32">
            <h1>Hello Alumni !</h1>
        </div>
        <div class="bg-white p-10 m-10 rounded-xl flex flex-col gap-6 items-center">
            <h1 class="text-3xl font-bold">Sign in</h1>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="flex flex-col gap-2">
                    <div class="py-1">
                        <input class="px-5 bg-gray-300" type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="py-1">
                        <input class="px-5" type="password" name="password" placeholder="Password" required>
                    </div>
                    <button class="bg-primaryYellow py-1 text-white font-bold rounded-full" type="submit">Sign In</button>
                </div>
            </form>
            <div class="flex flex-col items-center gap-1">
                <p class="text-xs text-customTextBlue cursor-pointer">Forgot password?</p>
                <p class="text-xs text-customTextBlue">Don't have an account? <strong class="text-black cursor-pointer">Sign up here</strong></p>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth >= 768) {
            window.location.href = "{{ route('login.show') }}";
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            window.location.href = "{{ route('login.show') }}";
        }
    });
</script>
</html>
