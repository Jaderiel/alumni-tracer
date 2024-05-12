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
    @if(Auth::user()->user_type === 'Admin' || Auth::user()->user_type === 'Super Admin')
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
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: .25rem;">
                {{ session('success') }}
            </div>
            @endif
            <ul>
                
                <div class="board-list">
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Course</td>
                                <td>Batch</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unverifiedUsers as $user)
                            <tr>
                            <td>
                                <div>
                                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
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
                                @unless($user->is_email_verified)
                                    <td class="action" style="display: flex">
                                        <a href="#" class="button approve-btn" data-form-id="{{ 'form-'.$user->id }}">Approve</a>
                                        <form id="{{ 'form-'.$user->id }}" method="POST" action="{{ route('user.approve', ['userId' => $user->id]) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                        <form action="{{ route('user.delete', ['userId' => $user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="button delete-btn" style="background-color: maroon;">Delete</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button style="padding: 10px; border-radius: 10px; background-color: gray; color: white;" disabled>approved</button>
                                    </td>
                                    <td></td>
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

            $('.delete-btn').click(function(e) {
                if (!confirm('Are you sure you want to delete this user?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>
