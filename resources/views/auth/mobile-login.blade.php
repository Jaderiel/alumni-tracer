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
                <div class="flex flex-col items-center">
                @if ($errors->any())
                
                    @foreach ($errors->all() as $error)
                        <p class="text-xs text-red-500">{{ $error }}</p>
                    @endforeach
                        
                @endif
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button class="bg-primaryYellow py-1 mt-4 px-7 text-white font-bold rounded-full" type="submit">Sign In</button>
                </div>
            </form>
            <div class="flex flex-col items-center gap-1">
                <p class="text-xs text-customTextBlue cursor-pointer">Forgot password?</p>
                <p class="text-xs text-customTextBlue">Don't have an account? <a href="{{ route('mobileSignUp.show') }}"><strong class="text-black cursor-pointer">Sign up here</strong></a></p>
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

<style>
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
        width: 90%;
        margin: 2px auto;
    }

    .input-group select {
        display: inline-block;
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

    .input-group input {
        width: 100%;
        height: 35px;   
        font-size: .70rem;
        padding: 1rem 3rem;
        font-size: .9rem;
        background-color: var(--gray);
        border: 0.125rem solid var(--white);
        outline: none;
        pointer-events: auto;
        padding-left: 0.90rem;
    }
</style>
