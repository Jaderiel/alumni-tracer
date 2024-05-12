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
<body>
    <section id="menu">
        <!-- Include the appropriate side navigation -->
        @if(Auth::user()->user_type === 'Admin' || Auth::user()->user_type === 'Super Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">

        @include('components.headernav')

        <h3 class="i-name">
            <a href="{{ route('events') }}" class="back-link"><i class="fas fa-arrow-left"></i></a>
            {{ $eventTitle }}
        </h3>

        <div class="board-list">
            <table width="100%" id="userTable">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Course</td>
                        <td>Batch</td>
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
                            <td>
                                <div>
                                    <p>{{ $user->course }}</p>
                                </div>
                            </td>
                            <td>
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
</style>