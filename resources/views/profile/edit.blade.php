<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body style="margin-top: 65px">
    @include('main')

    <section id="interface" class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

    <h3 class="i-name py-4 px-10">
        <a href="{{ route('user-profile') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a> Profile Settings
    </h3>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="bg-white mx-4 lg:mx-10">
        <div class="border border-black">
            <div class="heading">
                USER INFORMATION
            </div>
    
            <div class="panel-btn">
                <div class="row flex flex-col lg:flex-row justify-center lg:justify-between">
                    <div class="flex flex-col lg:flex-row ml-4 mt-2">
                        <div class="h-[100px] w-[100px] overflow-hidden relative ml-0 lg:ml-4 rounded-full border-2 border-gray-500">
                            @if (Auth::user()->profile_pic)
                            <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture" style="height: 100px; width: 100px; object-fit: cover;"> 
                            @else
                            <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <input id="file-upload" type="file" name="profile_pic" accept="image/*" class="px-0 lg:px-2 py-2 lg:py-0 self-start lg:self-end">
                    </div>

                    <div class="flex ml-3 h-full">
                            <button type="submit" class="btn-save"><i class="fa-regular fa-bookmark"></i> Save</button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button class="delete-button" type="submit"><i class="fa-solid fa-user-xmark"></i> Delete</button>
                        </form>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="first_name">First Name</label>
                        <div class="border-2 w-full p-2">
                            
                            <input type="text" class="w-full outline-none" id="first_name" name="first_name" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="middle_name">Middle Name</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="last_name">Last Name</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="last_name" name="last_name" value="{{ $user->last_name }}">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="course">Course</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="course" name="course"> <!-- Added name attribute -->
                                <option value="{{ $user->course }}">{{ $user->course }}</option>
                                <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BAB)</option>
                                <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology (BSAT)</option>
                                <option value="Bachelor of Science in Accounting Information Systems">Bachelor of Science in Accounting Information Systems (BSAIS)</option>
                                <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work (BSSW)</option>
                                <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems (BSIS)</option>
                                <option value="Associate in Computer Technology">Associate in Computer Technology (ACT)</option>
                                <option value="Computer Technology">Computer Technology (CT)</option>
                                <option value="Computer Programming">Computer Programming (CP)</option>
                                <option value="Health Care Services">Health Care Services (HCS)</option>
                                <option value="International Cookery">International Cookery (IC)</option>
                                <option value="Mass Communication">Mass Communication (MC)</option>
                                <option value="Nursing Student">Nursing Student (NS)</option>
                                <option value="Office Management">Office Management (OM)</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="batch">Batch</label>
                        <div class="border-2 w-full p-2">
                                <select class="w-full outline-none" name="batch" id="batch" required>
                                    <option value="{{ $user->batch }}">{{ $user->batch }}</option>
                                        @for ($year = date('Y'); $year >= 2006; $year--)
                                        @php
                                        $nextYear = $year + 1;
                                        @endphp
                                        <option value="{{ $year }} - {{ $nextYear }}">{{ $year }}-{{ $nextYear }}</option>
                                        @endfor
                                </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="email">Email Address</label>
                        <div class="border-2 w-full p-2">
                            <input type="email" class="w-full outline-none" id="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="username">Username</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="username" name="username" value="{{ $user->username }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="heading" style="margin-top: 30px">
                USER EMPLOYMENT INFORMATION
            </div>
        
            <div class="panel-btn flex flex-col my-4">
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="employment">Employment Status</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="employment" name="employment_status">
                                <option value="employed" {{ $user->employment && $user->employment->is_employed ? 'selected' : '' }}>Employed</option>
                                <option value="unemployed" {{ (!$user->employment || !$user->employment->is_employed) ? 'selected' : '' }}>Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="date">Date of First Employment</label>
                        <div class="border-2 w-full p-2">
                            <input type="date" class="w-full outline-none" id="date" name="date_of_first_employment" value="{{ $user->employment ? $user->employment->date_of_first_employment : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="date2">Date of Employment</label>
                        <div class="border-2 w-full p-2">
                            <input type="date" class="w-full outline-none" id="date2" name="date_of_employment" value="{{ $user->employment ? $user->employment->date_of_employment : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="salary">Salary per Year</label>
                        <select class="border-2 w-full p-2" name="annual_salary" value="{{ $user->employment ? $user->employment->annual_salary : '' }}">
                            <option value="" disabled selected>{{ $user->employment ? $user->employment->annual_salary : '' }}</option>
                            <option value="₱50,000 - ₱100,000">₱50,000 - ₱100,000</option>
                            <option value="₱100,001 - ₱200,000">₱100,001 - ₱200,000</option>
                            <option value="₱200,001 - ₱300,000">₱200,001 - ₱300,000</option>
                            <option value="₱300,001 - ₱400,000">₱300,001 - ₱400,000</option>
                            <option value="₱400,001 - ₱500,000">₱400,001 - ₱500,000</option>
                            <option value="₱500,001 - ₱600,000">₱500,001 - ₱600,000</option>
                            <option value="₱600,001 - ₱700,000">₱600,001 - ₱700,000</option>
                            <option value="₱700,001 - ₱800,000">₱700,001 - ₱800,000</option>
                            <option value="₱800,001 - ₱900,000">₱800,001 - ₱900,000</option>
                            <option value="₱900,001 - ₱1,000,000">₱900,001 - ₱1,000,000</option>
                            <option value="₱1,000,001 - ₱1,100,000">₱1,000,001 - ₱1,100,000</option>
                            <option value="₱1,100,001 - ₱1,200,000">₱1,100,001 - ₱1,200,000</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="industry">Industry</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="industry" name="industry" value="{{ $user->employment ? $user->employment->industry : '' }}">
                                <option value="{{ $user->employment ? $user->employment->industry : '' }}" disabled selected>{{ $user->employment ? $user->employment->industry : '' }}</option>
                                <option value="IT Industry">IT Industry</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Finance">Finance</option>
                                <option value="Education">Education</option>
                                <option value="Construction">Construction</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Retail">Retail</option>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Entertainment">Entertainment</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="job">Job Title</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="job" name="job_title" value="{{ $user->employment ? $user->employment->job_title : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="company">Company</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="company" name="company_name" value="{{ $user->employment ? $user->employment->company_name : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
    <label for="employment">Do you own a business?</label>
    <div class="border-2 w-full p-2">
        <select class="w-full outline-none" id="ownedBusiness" name="is_owned_business">
            <option value="yes" {{ $user->employment && $user->employment->is_owned_business ? 'selected' : '' }}>Yes</option>
            <option value="no" {{ (!$user->employment || !$user->employment->is_owned_business) ? 'selected' : '' }}>No</option>
        </select>
    </div>
</div>


                </div>
                <div class="flex flex-col mx-4 lg:mx-10 gap-2 my-2">
                    <label for="location">Location</label>
                    <div class="border-2 w-full p-2">
                        <select id="country" class="w-full outline-none">
                            <option value="" selected disabled>Select Country</option>
                        </select>
                    </div>
                    <div class="border-2 w-full p-2">
                        <select id="region" class="w-full outline-none" disabled>
                            <option class="w-full outline-none" value="" selected disabled>Select Region</option>
                        </select>
                    </div>
                    <div class="border-2 w-full p-2">
                        <select id="province" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Province</option>
                        </select>
                    </div>
                    <div class="border-2 w-full p-2">
                        <select id="city" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select City/Municipality</option>
                        </select>
                    </div>
                    <div class="border-2 w-full p-2">
                        <select id="barangay" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Barangay</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <div class="border-2 w-full p-2">
                        <input type="text" id="location" class="w-full outline-none" name="company_address" value="{{ $user->employment ? $user->employment->company_address : '' }}" placeholder="Location" readonly>
                    </div>
                </div>
            </div>


            <div class="heading">
                USER POST-GRADUATION INFORMATION
            </div>
                    
            <div class="panel-btn">
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2" style="margin-top: 25px">
                    <div class="w-full">
                        <label for="degree">Degree Status</label>
                        <div class="border-2 w-full p-2" style="margin-bottom: 25px">
                            <select class="w-full outline-none" id="degree" name="degree">
                                <option value="" {{ is_null($user->degree) ? 'selected' : '' }}>None</option>
                                <option value="PhD" {{ $user->degree == 'PhD' ? 'selected' : '' }}>Ph.D.</option>
                                <option value="Masters" {{ $user->degree == 'Masters' ? 'selected' : '' }}>Master's</option>
                                <option value="Bachelors" {{ $user->degree == 'Bachelors' ? 'selected' : '' }}>Bachelor's</option>
                                <option value="Associate" {{ $user->degree == 'Associate' ? 'selected' : '' }}>Associate</option>
                                <option value="Diploma" {{ $user->degree == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Certificate" {{ $user->degree == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
</section>

</body>
<script src="{{ asset('js/job-location.js') }}"></script>

</html>

<style>
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
</style>