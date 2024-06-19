<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section id="" class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">
            Recent Jobs
        </h3>

        <div class="bg-white p-4 m-4 lg:m-10">
            <div class="job flex flex-col lg:flex-row justify-center items-center mb-4 gap-2 lg:gap-4 mx-0 lg:mx-10">
                <button class="up-job w-full">List of Job posted</button>
                <div class="search w-full">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchJobs()">
                </div>
                <div class="post-job py-2 w-full hover:bg-customYellow">
                    <a href="{{ route('job-post') }}" class="flex justify-center items-center"><button>Job posting</button></a>
                </div>
            </div>

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

            <div class="flex flex-col justify-center mx-2 lg:mx-10" id="jobList">
                @foreach($jobs as $job)
                    <div class="job-div mb-6 col-lg-9">
                        <div class="job-details">
                            <div class="flex justify-between items-center">
                                <div class="col">
                                    <h3 class="title font-bold">{{ $job->job_title }}</h3>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ $job->link }}" class="bg-yellow-400 text-white px-4 py-1 rounded-sm" target="_blank">Apply</a>
                                    @if(Auth::check() && (Auth::user()->user_type === 'Super Admin' || Auth::user()->id === $job->user_id))
                                        <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                            <button class="bg-yellow-400 text-white px-4 py-1 rounded-sm">Edit</button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-4 py-4">
                                <div class="col-auto">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                                <div class="col">
                                    {{ $job->job_location }}
                                </div>
                            </div>
                            <div class="flex gap-4 py-4">
                                <div class="col-auto">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="col">
                                    {{ $job->salary }}
                                    <i class="fas fa-clock ml-3 mr-2"></i> {{ $job->job_type }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="whitespace-pre-wrap">{{ $job->job_description }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="job-timestamp" data-timestamp="{{ $job->created_at->timestamp }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/jobs.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ("{{ session('success') }}") {
                $('#successMessage').fadeIn().delay(5000).fadeOut();
            }

            if ("{{ session('error') }}") {
                $('#errorMessage').fadeIn().delay(5000).fadeOut();
            }
        });

        function formatTimeAgo(timestamp) {
            const now = new Date();
            const createdTime = new Date(timestamp * 1000); // Convert to milliseconds
            const timeDiff = Math.abs(now - createdTime);

            const minute = 60 * 1000;
            const hour = minute * 60;
            const day = hour * 24;

            if (timeDiff < minute) {
                return 'now';
            } else if (timeDiff < hour) {
                const minutes = Math.floor(timeDiff / minute);
                return minutes + ' min ago';
            } else if (timeDiff < day) {
                const hours = Math.floor(timeDiff / hour);
                return hours + ' hr ago';
            } else {
                return createdTime.toLocaleDateString('en-US');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const jobTimestamps = document.querySelectorAll('.job-timestamp');
            jobTimestamps.forEach(function(element) {
                const timestamp = element.getAttribute('data-timestamp');
                element.textContent = formatTimeAgo(timestamp);
            });
        });

        function searchJobs() {
            let input, filter, jobList, jobDiv, title, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            jobList = document.getElementById('jobList');
            jobDiv = jobList.getElementsByClassName('job-div');

            for (i = 0; i < jobDiv.length; i++) {
                title = jobDiv[i].getElementsByClassName('title')[0];
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    jobDiv[i].style.display = "";
                } else {
                    jobDiv[i].style.display = "none";
                }
            }
        }
    </script>

    <style>
        .i-name {
            color: #2D55B4;
            font-size: 24px;
            font-weight: 700;
            margin-top: 20px;
            margin-left: 10px;
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
    </style>
</body>
</html>
