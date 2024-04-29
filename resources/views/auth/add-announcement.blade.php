<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <!-- <script src="jquery-3.5.1.min.js"></script> -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
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
            <a href="{{ route('events') }}" class="back-link"><i class="fas fa-arrow-left"></i></a>Add Amnouncement
        </h3>

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

        </div>

    </div>

    <div class="container">
        <div class="panel">
            <div class="bio-graph-heading">
                Post and press
            </div>
            <div class="panel-body bio-graph-info">
                <div class="row">
                    <p class="bold">
                        Fill in the subject and body of event details and press ‘POST’ to notify all alumni
                    </p>
                </div>

                
                    <form action="{{ route('ann.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-container">
                            <div class="title-input">
                                <input type="text" name="ann_title" placeholder="Title">
                            </div>
                        </div> 
                        <textarea placeholder="Event details" name="ann_details" class="event-details"></textarea>
                        <button type="submit" class="post-button-ann">POST</button>
                    </form>
            </div>
        </div>
    </div>

</section>

</body>
<!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
<!-- <script src="{{ asset('js/events.js') }}"></script> -->
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
    .container {
        height: 450px
    }
    .date-and-time {
        margin-left: 40px;
        margin-bottom: 10px;
        display: flex;
    }
</style>