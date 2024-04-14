<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approvals</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <section id=menu>
        @include('components.admin-sidenav')
    </section>

    <section id="interface">
        <h1>Approvals</h1>

        <div>
            <h2>Users pending approval:</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <ul>
                @foreach($unverifiedUsers as $user)
                <div style="display: flex; flex-direction: row; padding-left: 50px; padding-right: 50px; justify-content: space-between; margin-top: 10px">
                    <p>{{ $user->username }}</p>
                    <p>{{ $user->email }}</p>
                    @unless($user->is_email_verified)
                    <form method="POST" action="{{ route('user.updateVerification', ['userId' => $user->id]) }}">
                            @method('PUT')
                            @csrf
                            <button type="submit" style="padding: 10px; border-radius: 10px; background-color: green; color: white;">approve</button>
                        </form>
                    @else
                        <button style="padding: 10px; border-radius: 10px; background-color: gray; color: white;" disabled>approved</button>
                    @endunless
                </div>
                @endforeach
            </ul>
        </div>
    </section>
</body>
</html>
