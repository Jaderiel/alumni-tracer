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
        <div class="text-white text-4xl font-bold mt-10">
            <h1>Join with us !</h1>
        </div>
        <div class="bg-white p-10 m-10 rounded-xl flex flex-col items-center">
            <h1 class="text-3xl font-bold">Create Account</h1>
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <div class="flex flex-col items-center">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-500">{{ $error }}</p>
                        @endforeach
                    @endif
                    <div class="input-group">
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="middle_name" placeholder="Middle Name">
                    </div>
                    <div class="input-group">
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group">
                        <select name="course" id="course" required>
                                <option value="" selected disabled>Course</option>
                                <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BAB)</option>
                                <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology (BSAT)</option>
                                <option value="Bachelor of Science in Accounting Information Systems">Bachelor of Science in Accounting Information Systems (BSAIS)</option>
                                <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work (BSSW)</option>
                                <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems (BSIS)</option>
                                <option value="Associate in Computer Technology">Associate in Computer Technology (ACT)</option>
                                <option value="Computer Technology">Computer Technology (CT)</option>
                                <option value="Computer Programming">Computer Programming (CP)</option>
                                <option value="Health Care Services">Health Care Services (HCS)</option>
                                <option value="International Cookery">International Cookery (IC)</option>
                                <option value="Mass Communication">Mass Communication (MC)</option>
                                <option value="Nursing Student">Nursing Student (NS)</option>
                                <option value="Office Management">Office Management (OM)</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <select name="batch" id="batch" required>
                            <option value="" selected disabled>Batch</option>
                            @for ($year = date('Y'); $year >= 2006; $year--)
                                @php
                                    $nextYear = $year + 1;
                                @endphp
                                <option value="{{ $year }} - {{ $nextYear }}">{{ $year }}-{{ $nextYear }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="text-xs text-customTextBlue">
                        <input type="checkbox" id="termsCheckbox" required>
                        <label for="termsCheckbox">I accept the <span id="termsLink">Terms of Use and Privacy Policy</span></label>
                    </div>
                    <button class="bg-primaryYellow px-7 py-1 text-white font-bold rounded-full" type="submit">Sign Up</button>
                </div>
            </form>
            <div class="flex flex-col items-center gap-1">
                <p class="text-xs text-customTextBlue">Already have an account? <a href="{{ route('mobileLogin.show') }}"><strong class="text-black cursor-pointer">Sign in here</strong></a></p>
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
