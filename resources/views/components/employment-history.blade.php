<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment History</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body style="margin-top: 70px">
    @include('main')
    
    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name-user">
        <a href="{{ route('profile.edit') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>Employment History
        </h3>
    </section>
</body>
</html>

<style>
    .back-link {
        margin-top: 20px;
        margin-right: 10px;
        background-color: #FFFFFF;
        color: #2974A7;
        text-decoration: none;
        padding: 5px 13px;
        border-radius: 6px;
        border: 1px solid #2974A7;
        font-size: 13px;
    }

    .back-link:hover {
        background-color: #a6d0ec;
    }
</style>