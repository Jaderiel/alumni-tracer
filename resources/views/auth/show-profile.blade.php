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
            <a href="{{ route('alumni-list') }}" class="back-link"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
            Profile
        </h3>

        <div class="bg-white p-4 my-4 mx-4 lg:mx-10">
            <div class="flex items-baseline justify-between mx-0 lg:mx-32">
                <div class="flex items-center gap-4">
                    <div class="h-[100px] w-[100px] overflow-hidden relative">
                        @if ($user->profile_pic)
                        <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture" style="height: 100%; width: 100%; object-fit: cover;"> 
                        @else
                        <img src="{{ asset('images/user_avatar.jpg') }}" alt="Placeholder Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div>
                        <h1 class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
                        <p class="text-xs">{{ $user->username }}</p>
                    </div>
                </div>
            </div>

            <div class="mx-0 lg:mx-32">
                <p>{{ $user->course }}</p>
                <p>{{ $user->batch }}</p>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
</html>