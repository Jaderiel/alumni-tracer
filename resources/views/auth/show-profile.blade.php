<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="profile.js" defer></script>
</head>

<body>
    <section id="menu">
        @if(Auth::user()->user_type === 'Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">
        Profile
        </h3>

        <div style="margin-top: 20px; display: flex; flex-direction: row; gap:20px; padding-left: 20px; align-items: center;">
            <div class="profile-info">
                @if ($user->profile_pic)
                <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture" style="height: 100px; width: 100px;"> 
                @else
                <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100px; width: 100px;">
                @endif
            </div>
            <div>
                <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
                <p>{{ $user->username }}</p>
            </div>
            @if(auth()->check() && auth()->user()->user_type === 'Admin')
                <a href="{{ route('profile') }}">
                    <button style="height: 20px">Profile Settings</button>
                </a>
            @endif
        </div>

        <div style="padding-left: 20px; padding-top: 20px">
            <p>{{ $user->course }}</p>
            <p>{{ $user->batch }}</p>
        </div>

    </section>
</div>

</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
</html>