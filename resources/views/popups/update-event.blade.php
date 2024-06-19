<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section id="interface" class="ml-0 lg:ml-72 w-full">
        <h3 class="i-name">
            <a href="{{ route('events') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>
            Edit Event
        </h3>

        <div style="display: flex; flex-direction: row; gap: 35px">
            <div class="main-body ml-4 mr-2">
                @if(session('error'))
                    <div id="errorMessage" class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div id="successMessage" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div id="errorMessage" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white p-4 m-4 lg:m-10">
            <div class="panel">
                <div class="bio-graph-heading">
                    EDIT POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                            To edit, make the necessary changes to the title, image, date, time, and event details, then press 'SAVE' to update.
                        </p>
                    </div>

                    <form action="{{ route('update.event', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                            <div class="border-2 w-full p-2">
                                <input type="text" name="event_title" value="{{ $event->event_title }}" placeholder="Title" class="w-full outline-none">
                            </div>
                            <div class="border-2 w-full lg:w-1/2 p-2">
                                <label for="file-upload" class="cursor-pointer" id="file-upload-label">
                                    <span>{{ basename($event->media_url) ?: 'Add Image' }}</span>
                                    <i class="fas fa-image"></i>
                                </label>
                                <input id="file-upload" type="file" name="image" accept="image/*" class="file-upload w-full">
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                            <div class="border-2 w-full p-2 cursor-pointer">
                                <input type="date" name="event_date" value="{{ $event->event_date }}" placeholder="Date">
                            </div>
                            <div class="border-2 w-full p-2 cursor-pointer">
                                <input type="time" name="event_time" value="{{ $event->event_time }}" placeholder="Time">
                            </div>
                        </div>
                        <div class="flex mx-4 lg:mx-10">
                            <textarea placeholder="Event details" name="event_details" class="border-2 w-full h-32 p-2">{{ $event->event_details }}</textarea>
                        </div>
                        <button type="submit" class="post-button-ann text-white">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('file-upload').addEventListener('change', function() {
            var fileName = this.files[0].name;
            var label = document.getElementById('file-upload-label');
            label.innerHTML = '<span>' + fileName + '</span> <i class="fas fa-image"></i>';
        });

        $(document).ready(function() {
            if ($("#successMessage").length) {
                $("#successMessage").fadeIn().delay(5000).fadeOut();
            }
            if ($("#errorMessage").length) {
                $("#errorMessage").fadeIn().delay(5000).fadeOut();
            }
        });
    </script>

    <style>
        .i-name {
            color: #2D55B4;
            font-size: 24px;
            font-weight: 700;
            margin-top: 20px;
            margin-left: 10px;
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

        .alert {
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
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .alert-success {
            background-color: #4CAF50;
        }

        .alert-danger {
            background-color: #F44336;
        }
    </style>
</body>

</html>
