<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section id="" class="flex flex-col ml-0 lg:ml-72 w-full justify-center">
        <h3 class="i-name">Events & Announcement</h3>

        <div class="event flex flex-col lg:flex-row mx-3 p-5 gap-2">
            @if(auth()->check() && (auth()->user()->user_type == 'Alumni'))
            @elseif(auth()->check() && (auth()->user()->user_type != 'Alumni'))
            <a href="{{ route('events') }}" class="up-event w-full">Upcoming Events and Announcement</a>
            <a href="{{ route('add-event') }}" class="post-event w-full">Add Event</a>
            <a href="{{ route('add-ann') }}" class="post-event w-full">Add Announcement</a>
            @endif
        </div>

        <div class="flex flex-col lg:flex-row justify-center items-center lg:items-start lg:justify-between pr-0 lg:pr-10 gap-5 lg:gap-10">
            <div class="ml-0 lg:ml-8">
                @if(session('error'))
                    <div id="errorMessage" class="error-popup">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div id="successMessage" class="success-popup">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($events as $event)
                    <div class="card w-[400px] lg:w-[720px] rounded-2xl">
                        <div class="card-body">
                            <div class="panel widget rounded-t-2xl lg:rounded-xl">
                                <div class="flex flex-col lg:flex-row h-auto lg:h-[250px]">
                                    <div class="col-5 w-92 lg:w-[600px]">
                                        <div class="lateral-picture">
                                            <img src="{{ $event->media_url }}" alt="" class="">
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full p-5">
                                    @if(\App\Models\EventRegistration::where('user_id', Auth::user()->id)->where('event_id', $event->id)->exists())
                                        <div class="text-right">
                                            <span class="text-green-500">REGISTERED</span>
                                        </div>
                                    @else
                                        @if(auth()->check() && (auth()->user()->user_type != 'Alumni'))
                                        <div class="w-full flex flex-col items-center lg:items-end">
                                            <div class="text-right" style="padding: 10px">
                                                <a href="{{ route('get.registered.users', ['eventId' => $event->id]) }}" style="display: inline-block; padding: 10px 20px; color: #fff; text-decoration: none; border-radius: 5px;" class="view-btn">View Registered Users</a>
                                            </div>
                                            <div class="text-right" style="padding: 10px">
                                                <form id="delete-form" action="{{ route('delete.event', ['id' => $event->id]) }}" method="POST" onsubmit="return confirmDelete();" style="display: inline-block; width: 100px;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" style="width: 100%; color: #fff; padding: 8px 16px; border: none; border-radius: 5px;" class="delete-btn">Archive</button>
                                                </form>
                                                <a href="{{ route('update-event', ['id' => $event->id]) }}" style="display: inline-block; width: 100px; margin-left: 10px;">
                                                <button type="submit" style="width: 100%; color: #fff; padding: 8px 16px; border: none; border-radius: 5px;" class="edit-btn">Edit</button>
                                                </a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="text-right">
                                            <a href="#" onclick="return confirmRegistration('{{ route('register-to-event', ['user_id' => Auth::user()->id, 'event_id' => $event->id]) }}');" id="registerBtn" class="btn btn-success btn-sm mb-1 register-btn">REGISTER</a>
                                        </div>
                                        @endif
                                    @endif
                                        <div style="display: flex; flex-direction: column; gap: 5px">
                                            <div style="margin-top: 10px;">
                                                <span class="text-sm">{{ $event->event_date->format('F d, Y') }} | {{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>
                                            </div>
                                            <div>
                                                <strong class="event-title text-sm">{{ $event->event_title }}</strong>
                                            </div>
                                            <div class="text-xs">{{ $event->event_details }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center lg:justify-start px-5 lg:px-0">
                @include('components.announcements')
            </div>
        </div>

    </section>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/events.js') }}"></script>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to archive this event? This action cannot be undone.');
        }

        function confirmRegistration(url) {
            if (confirm('Are you sure you want to register for this event?')) {
                window.location.href = url;
            }
            return false;
        }

        document.addEventListener('DOMContentLoaded', function() {
            if ("{{ session('success') }}") {
                $('#successMessage').fadeIn().delay(5000).fadeOut();
            }

            if ("{{ session('error') }}") {
                $('#errorMessage').fadeIn().delay(5000).fadeOut();
            }
        });
    </script>

    <style>
        .button {
            padding: 3px 17px;
            background-color: #2DC04D;
            color: #fff;
            border: 2px solid green;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .register-btn {
            margin: 10px;
        }

        .success-popup, .error-popup {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .success-popup {
            background-color: #4CAF50;
        }

        .error-popup {
            background-color: #F44336;
        }

        .show-success {
            background-color: #D4EDDA;
            color: green;
            padding: 15px 130px;
            margin: 15px 0 20px;
            text-align: center;
        }

        .view-btn {
        background-color: #007bff;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #BB0237;
        }

        .delete-btn:hover {
            background-color: #850227;
        }

        .edit-btn {
        background-color: #00A36C;
        }

        .edit-btn:hover {
            background-color: #016443;
        }
    </style>
</body>
</html>
