<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body style="margin-top: 70px">
    @include('main')

    <section id="" class="ml-0 lg:ml-72 w-full">

        <h3 class="i-name mb-1">
        <a href="{{ route('events') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>
            {{ $eventTitle }}
        </h3>

        <div class="px-5 lg:px-10 py-5">
            <div class="board-list flex justify-center m-0 w-full">
                <table width="100%" id="userTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td class="hide-on-small">Course</td>
                            <td class="hide-on-small">Batch</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registeredUsers as $user)
                            <tr>
                                <td>
                                    <div>
                                        <h5>{{ $user->full_name }}</h5>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </td>
                                <td class="hide-on-small">
                                    <div>
                                        <p>{{ $user->course }}</p>
                                    </div>
                                </td>
                                <td class="hide-on-small">
                                    <div>
                                        <p>{{ $user->batch }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="button">View</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>

<style>
    .back-link {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
    }

    .back-link:hover {
        color: #000; 
    }

    .hide-on-small {
        display: table-cell;
    }

    /* Media query to hide on small screens */
    @media (max-width: 600px) {
        .hide-on-small {
            display: none;
        }
    }

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