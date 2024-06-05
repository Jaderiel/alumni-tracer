<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jobs Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">
            Edit Job
        </h3>

        <div style="display: flex; flex-direction: row; gap: 35px">
            <div class="main-body mt-7 ml-4 mr-2">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="text-green-600">
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
                    EDIT JOB
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                    </div>

                    <!-- Form for updating job details -->
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                        <div class="border-2 w-full p-2">
                            <input type="text" name="job_title" value="{{ $job->job_title }}" class="w-full outline-none" placeholder="Job Title">
                        </div>
                        <div class="border-2 w-full p-2">
                            <input type="text" name="company" value="{{ $job->company }}" class="w-full outline-none" placeholder="Company">
                        </div>
                    </div>

                    <div class="flex flex-col mx-4 lg:mx-10 gap-2 my-2">
                        <div class="border-2 w-full p-2">
                            <select id="country" class="form-control mb-2">
                                <option value="" selected disabled>Select Country</option>
                            </select>
                        </div>
                        <div class="border-2 w-full p-2">
                            <select id="region" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Region</option>
                            </select>
                        </div>
                        <div class="border-2 w-full p-2">
                            <select id="province" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Province</option>
                            </select>
                        </div>
                        <div class="border-2 w-full p-2">
                            <select id="city" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select City/Municipality</option>
                            </select>
                        </div>
                        <div class="border-2 w-full p-2">
                            <select id="barangay" class="form-control mb-2" disabled>
                                <option value="" selected disabled>Select Barangay</option>
                            </select>
                        </div>
                        <div class="border-2 w-full p-2">
                            <input type="text" id="location" class="w-full outline-none" name="job_location" value="{{ $job->job_location }}" placeholder="Location" readonly>
                        </div>
                    </div>
                    
                    <div class="flex flex-col mx-4 lg:mx-10 gap-2 my-2">
                        <select class="border-2 w-full p-2" name="job_type">
                            <option value="{{$job->job_type}}" class="type" disabled selected>{{$job->job_type}}</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                        </select>
                        <select class="border-2 w-full p-2" name="salary">
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
                        <div class="border-2 w-full p-2">
                            <input type="text" name="link" value="{{$job->link}}" class="w-full outline-none" placeholder="Link where can apply">
                        </div>
                    </div>
                    
                    <div class="flex flex-col mx-4 lg:mx-10 gap-2 my-2">
                        <div class="border-2 w-full p-2">
                            <textarea class="w-full outline-none" name="job_description" value="{{$job->job_description}}" placeholder="Job Description">{{$job->job_description}}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-center gap-2 lg:gap-6">
                        <div class="post-button-holder">
                            <button class="post-button-annn" type="submit">SAVE</button>
                        </div>
                            
                        </form>

                        <div class="flex justify-center">
                            <form id="delete-form" action="{{ route('delete.job', $job->id) }}" method="POST" onsubmit="return confirmDelete();">
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
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post? This action cannot be undone.');
    }
</script>
</html>

<style>
    .location-holder {
        margin-bottom: 10px;
        margin-left: 30px;
        margin-right: 30px
    }

    .post-button-annn {
        padding: 5px 100px;
        /* margin-top: 10px; */
        background-color: #00A36C;
        border-radius: 2px;
        border-color: transparent;
        color: white;
    }

    .delete-button-annn {
        padding: 5px 100px;
        /* margin-top: 10px; */
        background-color: maroon;
        border-radius: 2px;
        border-color: transparent;
        color: white;
    }

    .post-button-holder {
        display: flex;
        justify-content: center
    }

    /* .eme {
        display: flex;
        gap: 10px;
        justify-content: center;
    } */

    .job-container {
        /* margin-left: 70px;
        margin-right: 100px; */
        background-color: white;
        margin-bottom: 50px;
        padding-bottom: 20px;
        /* padding-top: 10px */
    }

</style>
