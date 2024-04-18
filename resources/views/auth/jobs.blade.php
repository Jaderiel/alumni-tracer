<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jobs.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <section id="menu">
    @if(Auth::user()->user_type === 'Admin')
        @include('components.admin-sidenav')
    @else
        @include('components.sidenav')
    @endif
    </section>

    <div class="popup" id="popup">
      <div class="create">
          <i class="fa-solid fa-circle-xmark" onclick="closePopup()"></i>
          <div class="panel">
            <div class="bio-graph-heading">
                EDIT POST
            </div>
            <div class="panel-body bio-graph-info">
                <div class="row">
                    <p class="bold">
                        Fill in the subject and body of job details and press ‘POST’ to notify all alumni
                    </p>
                </div>

                <div class="input-container">
                    <div class="title-input">
                        <input type="text" class="input-job-title" placeholder="Job Title">
                    </div>
                    <div class="title-input">
                        <input type="text" class="input-company" placeholder="Company">
                    </div>
                    <div class="title-input">
                        <input type="text" class="input-location" placeholder="Location">
                    </div>
                </div>
                
                <div class="input-container">
                    <select class="select-job-type">
                        <option value="" class="type" disabled selected>Job Type</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                    </select>
                    <select class="select-salary-range">
                        <option value="" disabled selected>Salary Range</option>
                        <option value="0-10000">$0 - $10,000</option>
                        <option value="10001-30000">$10,001 - $30,000</option>
                    </select>
                    <div class="title-input">
                        <input type="text" class="input-apply-link" placeholder="Link or email where can apply">
                    </div>
                </div>
                
                <textarea class="job-dets" placeholder="Job Description"></textarea>

            </div>

            <button class="post-button-ann">POST</button>
            
        </div>
      </div>
  </div>

    <section id="interface">
      @include('components.headernav')

        <h3 class="i-name">
            Recent Jobs
        </h3>

        <div class="container">
        <div class="job">
            <button class="up-job">List of Job posted</button>
            <div class="search">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <a href="{{ route('job-post') }}"><button class="post-job">Job posting</button></a>
        </div>

        
            <div class="row" >
              @foreach($jobs as $job)
              <div class="job-div col-lg-9">
                <div class="job-details">
                  <div class="row mb-3">
                    <div class="col">
                      <h3 class="title">{{ $job->job_title}}</h3>
                    </div>
                    <div class="col-auto">
                        <a href="{{ $job->link}}" class="btn btn-warning text-white mr-2">Apply</a>
                    </div> 
                    <a href="{{ route('jobs.show', ['job' => $job->id]) }}"><button class="post-job">Edit</button></a>
                  </div>
                  <div class="row mb-1">
                    <div class="col-auto">
                        <i class="fas fa-location-arrow"></i>
                    </div>
                    <div class="col">
                      {{ $job->job_location}} 
                    </div>
                  </div>
                  <div class="row mb-3">
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
                      <p>{{ $job->job_description}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      {{ $job->created_at}}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach  
    
    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>

</body>
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/jobs.js') }}"></script>
</html>