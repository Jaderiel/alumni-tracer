<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">
            Job Post
        </h3>

        <div style="display: flex; flex-direction: row; gap: 35px">
            <div class="main-body mt-7 ml-4 mr-2">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="show-success">
                    {{ session('success') }}
                </div>
            @endif
            </div>
        </div>

        <div class="con mx-5 lg:mx-20">
            <div class="event flex flex-col lg:flex-row justify-center items-center p-6 gap-2 mx-0 lg:mx-32 lg:gap-6">
                <a href="{{ route('jobs') }}" class="post-button w-full">List of Job posted</a>
                <a href="{{ route('job-post') }}" class="up-event w-full">Job posting</a>
            </div>
        </div>

        <div class="job-container mx-5 lg:mx-20">
            <div class="job-panel">
                <div class="bio-graph-heading">
                    CREATE POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                    <p class="bold">
                    Fill in the fields including the job title, company, location, job type, salary range, link, and job <br>description, then press 'POST' to notify all alumni.
                        </p>
                    
                </div>

            <form action="{{ route('job.store') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <div class="border-2 w-full p-2">
                        <input type="text" name="job_title" class="w-full outline-none" placeholder="Job Title">
                    </div>
                    <div class="border-2 w-full p-2">
                        <input type="text" name="company" class="w-full outline-none" placeholder="Company">
                    </div>
                    <!-- <div class="title-input">
                        <a href="{{ route('job-location.component') }}" class="show-location-button"><input type="text" name="job_location" class="form-control" placeholder="Location" value="{{ $jobLocation }}" readonly></a>
                    </div> -->
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                <div class="w-full">
                    <div class="border-2 w-full p-2">
                        <select id="country" class="w-full outline-none">
                            <option value="" selected disabled>Select Country</option>
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="border-2 w-full p-2">
                        <select id="region" class="w-full outline-none" disabled>
                            <option class="w-full outline-none" value="" selected disabled>Select Region</option>
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="border-2 w-full p-2">
                        <select id="province" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Province</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                <div class="w-full">
                    <div class="border-2 w-full p-2">
                        <select id="city" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select City/Municipality</option>
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="border-2 w-full p-2">
                        <select id="barangay" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Barangay</option>
                        </select>
                    </div>
                </div>
                </div>
                
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <div class="border-2 w-full p-2">
                        <input type="text" id="location" class="w-full outline-none" name="job_location" placeholder="Location" readonly>
                    </div>
                </div>
                    
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <select class="border-2 w-full p-2" name="job_type">
                        <option value="" class="type" disabled selected>Job Type</option>
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                    </select>
                    <select class="border-2 w-full p-2" name="salary">
                        <option value="" disabled selected>Select Salary Range</option>
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
                    <div class="border-2 w-full p-2">
                        <input type="text" name="link" class="w-full outline-none" placeholder="Application Link">
                    </div>
                </div>
                
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <textarea class="border-2 w-full p-2" name="job_description"    placeholder="Job Description"></textarea>
                </div>

                <div class="post-button-holder">
                    <button class="post-button-annn" type="submit">POST</button>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/job-location.js') }}"></script>
</html>

<style>
    .show-location-button:hover {
        text-decoration: none;
        cursor: pointer;
    }

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

    .job-container {
        /* margin-left: 70px; */
        /* margin-right: 100px; */
        background-color: white;
        margin-bottom: 50px;
        padding-bottom: 20px
    }

    .post-button-holder {
        display: flex;
        justify-content: center
    }

    .show-success{
    background-color: #D4EDDA;
    color: green;
    padding: 15px 100px;
    margin: 15px 60px;
    text-align:center;
}
</style>