<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="profile.js" defer></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">
        Profile
        </h3>

        <div class="bg-white p-4 my-4 mx-4 lg:mx-10">
            <div class="flex items-baseline justify-between mx-0 lg:mx-32">
                <div class="flex items-center gap-4">
                    <div class="">
                        @if (Auth::user()->profile_pic)
                        <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture" style="height: 100px; width: 100px;"> 
                        @else
                        <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100px; width: 100px;">
                        @endif
                    </div>
                    <div>
                        <h1 class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                        <p class="text-xs">{{ Auth::user()->username }}</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('profile.edit') }}" >
                        <button class="text-xs bg-customBlue text-white px-4 py-1 rounded-lg hover:bg-customTextBlue hover:text-black">Profile Settings</button>
                    </a>
                </div>
            </div>

            <div class="mx-0 lg:mx-32">
                <p>{{ Auth::user()->course }}</p>
                <p>{{ Auth::user()->batch }}</p>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
</html>