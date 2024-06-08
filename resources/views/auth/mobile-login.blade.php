<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <style>
        /* Your custom styles here */
        :root {
            --primary-color: #E8AF30;
            --secondary-color: #E8AF30;
            --black: #000000;
            --white: #ffffff;
            --gray: #efefef;
            --gray-2: #757575;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin: 2px auto;
        }

        .input-group input {
            width: 100%;
            height: 35px;
            font-size: .90rem;
            background-color: var(--gray);
            border: 0.125rem solid var(--white);
            outline: none;
            pointer-events: auto;
            padding-left: 0.60rem;
            color: var(--gray-2);
        }
    </style>
</head>
<body class="bg-customBlue font-Poppins">
    <div class="flex flex-col justify-center items-center px-6">
        <div class="text-white text-4xl font-bold mt-32">
            <h1>Hello Alumni!</h1>
        </div>
        <div class="bg-white px-1 py-4 my-5 w-full rounded-xl flex flex-col gap-6 items-center">
            <h1 class="text-3xl font-bold">Sign in</h1>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="flex flex-col w-[300px] items-center">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-center text-red-500">{{ $error }}</p>
                        @endforeach
                    @endif
                    <div class="input-group w-full">
                        <input class="px-2 w-full" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    </div>
                    <div class="input-group w-full">
                        <input class="px-2 w-full" type="password" name="password" placeholder="Password" required>
                    </div>
                    <button class="bg-primaryYellow py-1 mt-4 px-7 text-white font-bold rounded-full" type="submit">Sign In</button>
                </div>
            </form>
            <div class="flex flex-col items-center gap-1">
                <a href="{{ route('password.request') }}"><p class="text-xs text-customTextBlue cursor-pointer">Forgot password?</p></a>
                <p class="text-xs text-customTextBlue">Don't have an account? <a href="{{ route('mobileSignUp.show') }}"><strong class="text-black cursor-pointer">Sign up here</strong></a></p>
            </div>
        </div>
    </div>
</body>
</html>
