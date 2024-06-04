<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">s -->
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
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
            <div class="flex flex-col justify-center mx-2 lg:mx-10" id="jobList">
            @foreach($jobs as $job)
                <div class="job-div mb-6 col-lg-9">
                    <div class="job-details">
                        <div class="flex justify-between items-center">
                            <div class="col">
                                <h3 class="title font-bold">{{ $job->job_title}}</h3>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ $job->link}}" class="bg-yellow-400 text-white px-4 py-1 rounded-sm">Apply</a>
                                @if(Auth::check() && Auth::user()->user_type === 'Super Admin' || Auth::user()->id === $job->user_id)
                                <a href="{{ route('jobs.show', ['job' => $job->id]) }}"><button class="bg-yellow-400 text-white px-4 py-1 rounded-sm">Edit</button></a>
                                @endif
                            </div> 
                        </div>
                        <div class="flex gap-4 py-4">
                            <div class="col-auto">
                                <i class="fas fa-location-arrow"></i>
                            </div>
                            <div class="col">
                            {{ $job->job_location}} 
                            </div>
                        </div>
                        <div class="flex gap-4 py-4">
                            <div class="col-auto">
                                <i class="fas fa-money-bill"></i> 
                            </div>
                            <div class="col">
                            {{ $job->salary}}
                            <i class="fas fa-clock ml-3 mr-2"></i> {{ $job->job_type}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                            <p class="whitespace-pre-wrap">{{ $job->job_description}}</p>
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
    </section>
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/jobs.js') }}"></script>
<script>
    // Function to format the time difference
    function formatTimeAgo(timestamp) {
        const now = new Date();
        const createdTime = new Date(timestamp * 1000); // Convert to milliseconds
        const timeDiff = Math.abs(now - createdTime);

        // Define time intervals in milliseconds
        const minute = 60 * 1000;
        const hour = minute * 60;
        const day = hour * 24;

        // Calculate the time difference in terms of minutes, hours, or days
        if (timeDiff < minute) {
            return 'now';
        } else if (timeDiff < hour) {
            const minutes = Math.floor(timeDiff / minute);
            return minutes + ' min ago';
        } else if (timeDiff < day) {
            const hours = Math.floor(timeDiff / hour);
            return hours + ' hr ago';
        } else {
            // If the time difference is more than a day, return the date in a specific format
            return createdTime.toLocaleDateString('en-US');
        }
    }

    // Call the formatTimeAgo function for each job creation time and update the displayed time
    document.addEventListener('DOMContentLoaded', function() {
        const jobTimestamps = document.querySelectorAll('.job-timestamp');
        jobTimestamps.forEach(function(element) {
            const timestamp = element.getAttribute('data-timestamp');
            element.textContent = formatTimeAgo(timestamp);
        });
    });

    // Function to filter jobs based on search input
    function searchJobs() {
        // Declare variables
        let input, filter, jobList, jobDiv, title, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        jobList = document.getElementById('jobList');
        jobDiv = jobList.getElementsByClassName('job-div');

        // Loop through all job divs, and hide those who don't match the search query
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
</html>


