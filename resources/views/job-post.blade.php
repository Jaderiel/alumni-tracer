<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
</head>

<body>
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
            Job Post
        </h3>

        <div class="con">
            <div class="event">
                <a href="{{ route('jobs') }}" class="post-button">List of Job posted</a>
                <a href="{{ route('job-post') }}" class="up-event">Job posting</a>
            </div>
        </div>

        <div class="container">
            <div class="panel">
                <div class="bio-graph-heading">
                    CREATE POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                            Fill in the subject and body of job details and press ‘POST’ to notify all alumni
                        </p>
                    </div>

        <form action="{{ route('job.store') }}" method="POST">
                        @csrf
                    <div class="input-container">
                        <div class="title-input">
                            <input type="text" name="job_title" class="input-job-title" placeholder="Job Title">
                        </div>
                        <div class="title-input">
                            <input type="text" name="company" class="input-company" placeholder="Company">
                        </div>
                        <div class="title-input">
                            <input type="text" name="job_location" class="input-location" placeholder="Location">
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <select class="select-job-type" name="job_type">
                            <option value="" class="type" disabled selected>Job Type</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                        </select>
                        <input type="text" name="salary" class="input-job-title" placeholder="Salary">
                        <div class="title-input">
                            <input type="text" name="link" class="input-apply-link" placeholder="Link or email where can apply">
                        </div>
                    </div>
                    
                    <textarea class="job-details" name="job_description" placeholder="Job Description"></textarea>
                    
    
                </div>

            <button class="post-button-ann" type="submit">POST</button>
        </form>
        </div>
    </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>