<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    
    <!-- <div id="contriner" class="container"> -->
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
            Events & Announcement
        </h3>

        <div class="event" style="margin: 0px">
            <button href="{{ route('events') }}" class="up-event">Upcoming Events and Announcement</button>
            @if(auth()->check() && (auth()->user()->user_type == 'Admin'))
            <a href="{{ route('add-event') }}" class="post-event">Add Event</a>
            <a class="post-event">Add Announcement</a>
            @endif
        </div>

    <div style="display: flex; flex-direction: row; gap: 35px">

        <div class="main-body mt-7 ml-4 mr-2" style="margin-left: 15px;">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($events as $event)

            <div class="row">
                <div class="col-sm-12">
                    <div class="card" style="width: 750px; border-radius: 20px;">
                        <div class="card-body">
                            <div class="panel widget">
                                <div class="row row-table row-flush">
                                    <div class="col-5" style="padding: 0;">
                                        <div class="lateral-picture">
                                            <img src="{{ $event->media_url }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-xs-7 p-lg">
                                    @if(\App\Models\EventRegistration::where('user_id', Auth::user()->id)->where('event_id', $event->id)->exists())
                                        <div class="text-right">
                                            <span class="text-success">REGISTERED</span>
                                        </div>
                                    @else
                                        @if(auth()->check() && (auth()->user()->user_type == 'Admin'))
                                            <div class="text-right" style="padding: 10px">
                                                <a href="{{ route('get.registered.users', ['eventId' => $event->id]) }}" class="btn-sm btn-info mb-1">View Registered Users</a>
                                            </div>
                                        @else
                                        <div class="text-right">
                                            <a href="{{ route('register-to-event', ['user_id' => Auth::user()->id, 'event_id' => $event->id]) }}" id="registerBtn" class="btn btn-success btn-sm mb-1 register-btn">REGISTER</a>
                                        </div>
                                        @endif
                                    @endif

                                        <p>
                                            <span class="text-lg">{{ $event->event_date->format('F d, Y') }} | {{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>
                                        </p>
                                        <p>
                                            <strong class="event-title ">{{ $event->event_title }}</strong>
                                        </p>
                                        <p>{{ $event->event_details }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        </div>

        @include('components.announcements')

    </div>

</section>

</body>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/events.js') }}"></script>
</html>