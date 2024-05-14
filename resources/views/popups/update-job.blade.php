<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jobs Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section id="menu">
    @if(Auth::user()->user_type === 'Admin' || Auth::user()->user_type === 'Super Admin')
        @include('components.admin-sidenav')
    @else
        @include('components.sidenav')
    @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">
            Edit Job
        </h3>

        <div class="con">
            <div class="event">
                <a href="{{ route('jobs') }}" class="post-button">List of Job posted</a>
                <a href="{{ route('job-post') }}" class="up-event">Job posting</a>
            </div>
        </div>

        <div class="job-container">
            <div class="job-panel">
                <div class="bio-graph-heading">
                    EDIT JOB
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                    </div>

                    <!-- Form for updating job details -->
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-container">
                        <div class="title-input">
                            <input type="text" name="job_title" value="{{ $job->job_title }}" class="input-job-title" placeholder="Job Title">
                        </div>
                        <div class="title-input">
                            <input type="text" name="company" value="{{ $job->company }}" class="input-company" placeholder="Company">
                        </div>
                    </div>

                    <div class="location-holder">
                        <div class="title-input">
                            <select id="country" class="form-control mb-2">
                                <option value="" selected disabled>Select Country</option>
                            </select>
                        </div>
                        <div class="title-input">
                            <select id="region" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Region</option>
                            </select>
                        </div>
                        <div class="title-input">
                            <select id="province" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Province</option>
                            </select>
                        </div>
                        <div class="title-input">
                            <select id="city" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select City/Municipality</option>
                            </select>
                        </div>
                        <div class="title-input">
                            <select id="barangay" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Barangay</option>
                            </select>
                        </div>
                        <div class="title-input">
                            <input type="text" id="location" class="form-control" name="job_location" value="{{ $job->job_location }}" placeholder="Location" readonly>
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <select class="select-job-type" name="job_type">
                            <option value="{{$job->job_type}}" class="type" disabled selected>{{$job->job_type}}</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                        </select>
                        <select class="select-job-type" name="salary">
                            <option value="{{$job->salary}}" disabled selected>{{$job->salary}}</option>
                            <option value="₱5,000 - ₱10,000">₱5,000 - ₱10,000</option>
                            <option value="₱20,000 - ₱30,000">₱20,000 - ₱30,000</option>
                            <option value="₱30,001 - ₱40,000">₱30,001 - ₱40,000</option>
                            <option value="₱40,001 - ₱50,000">₱40,001 - ₱50,000</option>
                            <option value="₱50,001 - ₱60,000">₱50,001 - ₱60,000</option>
                            <option value="₱60,001 - ₱70,000">₱60,001 - ₱70,000</option>
                            <option value="₱70,001 - ₱80,000">₱70,001 - ₱80,000</option>
                            <option value="₱80,001 - ₱90,000">₱80,001 - ₱90,000</option>
                            <option value="₱90,001 - ₱100,000">₱90,001 - ₱100,000</option>
                            <option value="₱100,001 - ₱110,000">₱100,001 - ₱110,000</option>
                            <option value="₱110,001 - ₱120,000">₱110,001 - ₱120,000</option>
                        </select>
                        <div class="title-input">
                            <input type="text" name="link" value="{{$job->link}}" class="input-apply-link" placeholder="Link where can apply">
                        </div>
                    </div>
                    
                    <textarea class="job-details" name="job_description" value="{{$job->job_description}}" placeholder="Job Description">{{$job->job_description}}</textarea>
                    <div class="eme">
                        <div class="post-button-holder">
                            <button class="post-button-annn" type="submit">SAVE</button>
                        </div>
                            
                        </form>

                        <!-- Form for deleting job -->
                        <form id="delete-form" action="{{ route('delete.job', $job->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button-annn" type="submit">DELETE</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/job-location.js') }}"></script>
</html>

<style>
    .location-holder {
        margin-bottom: 10px;
        margin-left: 30px;
        margin-right: 30px
    }

    .post-button-annn {
        padding: 5px 100px;
        margin-top: 10px;
        background-color: #00A36C;
        border-radius: 2px;
        border-color: transparent;
        color: white;
    }

    .delete-button-annn {
        padding: 5px 100px;
        margin-top: 10px;
        background-color: maroon;
        border-radius: 2px;
        border-color: transparent;
        color: white;
    }

    .post-button-holder {
        display: flex;
        justify-content: center
    }

    .eme {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .job-container {
        margin-left: 70px;
        margin-right: 100px;
        background-color: white;
        margin-bottom: 50px;
        padding-bottom: 20px;
        /* padding-top: 10px */
    }

</style>
