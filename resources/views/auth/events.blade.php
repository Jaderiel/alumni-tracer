<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
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
            <button class="up-event">Upcoming Events and Announcement</button>
        </div>
    <div style="display: flex; flex-direction: row; gap: 35px">
        <div class="main-body mt-7 ml-4 mr-2" style="margin-left: 15px;">

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
                                        <div class="text-right">
                                            <a href="#" id="registerBtn" class="btn btn-success btn-sm mb-1 register-btn">REGISTER</a>
                                        </div>
                                        <p>
                                            <span class="text-lg">{{ $event->event_date->format('F d, Y') }} | {{ $event->event_date->format('g:i A') }}</span>
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="card" style="width: 750px; border-radius: 20px;">
                        <div class="card-body">
                            <div class="panel widget">
                                <div class="row row-table row-flush">
                                    <div class="col-5" style="padding: 0;">
                                        <div class="lateral-picture">
                                            <img src="./img/sample-pic.webp" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-xs-7 p-lg">
                                        <div class="text-right">
                                            <a href="#" id="registerBtn" class="btn btn-success btn-sm mb-1 register-btn">REGISTER</a>
                                        </div>
                                        <p>
                                            <span class="text-lg">March 17, 2024 | 4 p.m.</span>
                                        </p>
                                        <p>
                                            <strong class="event-title ">EVENT INVITATION</strong>
                                        </p>
                                        <p>Donec posuere neque in elit luctus tempor consequat enim egestas. Nulla
                                            dictum egestas leo at lobortis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second event card -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card" style="width: 750px; border-radius: 20px;">
                        <div class="card-body">
                            <div class="panel widget">
                                <div class="row row-table row-flush">
                                    <div class="col-5" style="padding: 0;">
                                        <div class="lateral-picture">
                                            <img src="./img/sample-pic.webp" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-xs-7 p-lg">
                                        <div class="text-right">
                                            <a href="#" id="registerBtn" class="btn btn-success btn-sm mb-1 register-btn">REGISTER</a>
                                        </div>
                                        <p>
                                            <span class="text-lg">March 17, 2024 | 4 p.m.</span>
                                        </p>
                                        <p>
                                            <strong class="event-title ">EVENT INVITATION</strong>
                                        </p>
                                        <p>Donec posuere neque in elit luctus tempor consequat enim egestas. Nulla
                                            dictum egestas leo at lobortis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card" style="width: 350px; border-radius: 20px;">
                <div class="card-body-announcement" style="background-color: #162F65">
                    <div class="card-body" style="display: flex; justify-content: center">
                        <h4 class="text-center" style="align-self: center">ANNOUNCEMENT!!</h4>
                    </div>
                </div>
                <div class="scrollable-div">
                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">ICT WEEK</p>
                            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nisi cumque deleniti, eum temporibus nostrum eligendi sint natus?</P>
                        </div>
                    </div>

                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">ICT WEEK</p>
                            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nisi cumque deleniti, eum temporibus nostrum eligendi sint natus?</P>
                        </div>
                    </div>

                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">ICT WEEK</p>
                            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nisi cumque deleniti, eum temporibus nostrum eligendi sint natus?</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- </div> -->

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })

        var registerButtons = document.querySelectorAll(".register-btn");
        registerButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            this.innerHTML = '<i class="fas fa-check"></i>';
        });
    });
    </script>



</body>
<script src="{{ asset('js/dashboard.js') }}"></script>
</html>