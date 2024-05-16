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

<style>
    .container-prof{
    background-color: #fff;  
    width: 96%;
    padding: 20px;
    margin: 20px;
    border-radius: 20px;
    }

    .btn-prof{
        padding: 10px;
        margin-left: 620px;
        
    }

</style>

<body style="margin-top: 70px">
    @include('main')

    <section id="interface">

        <h3 class="i-name">
        Profile
        </h3>

        <div class="container-prof">

            <div style="margin-top: 20px; display: flex; flex-direction: row; gap:20px; padding-left: 20px; align-items: center;">
                <div class="profile-info">
                    @if (Auth::user()->profile_pic)
                    <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture" style="height: 100px; width: 100px;"> 
                    @else
                    <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100px; width: 100px;">
                    @endif
                </div>
                <div>
                    <h1>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                    <p>{{ Auth::user()->username }}</p>
                </div>
                <a href="{{ route('profile') }}" >
                    <button class="btn-prof">Profile Settings</button>
                </a>
            </div>

            <div style="padding-left: 20px; padding-top: 20px">
                <p>{{ Auth::user()->course }}</p>
                <p>{{ Auth::user()->batch }}</p>
            </div>

        </div>

        
        
    </section>
</div>

</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
</html>