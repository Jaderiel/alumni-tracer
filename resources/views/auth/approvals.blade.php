<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approvals</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <section id=menu>
    @if(Auth::user()->user_type === 'Admin')
        @include('components.admin-sidenav')
    @else
        @include('components.sidenav')
    @endif
    </section>

    <section id="interface">

        @include('components.headernav')

        <h3 class="i-name">Approvals</h3>

        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <ul>
                
                <div class="board-list">
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Course</td>
                                <td>Batch</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unverifiedUsers as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->course }}</td>
                                <td>{{ $user->batch }}</td>
                                @unless($user->is_email_verified)
                                    <td class="action">
                                        <a href="#" class="button approve-btn" data-form-id="{{ 'form-'.$user->id }}">Approve</a>
                                        <form id="{{ 'form-'.$user->id }}" method="POST" action="{{ route('user.updateVerification', ['userId' => $user->id]) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button style="padding: 10px; border-radius: 10px; background-color: gray; color: white;" disabled>approved</button>
                                    </td>
                                @endunless
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </ul>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.approve-btn').click(function(e) {
                e.preventDefault();
                var formId = $(this).data('form-id');
                $('#' + formId).submit();
            });
        });
    </script>
</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>
