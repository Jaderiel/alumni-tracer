<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="profile.js" defer></script>
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
        <a href="{{ route('user-profile') }}" class="back-link"><i class="fas fa-arrow-left"></i></a> Profile Settings
        </h3>
        
        <div class="container">
            <div class="panel">
                <div class="heading">
                    USER INFORMATION
                </div>
                <div class="panel-btn">
                    <div class="row">
                        <a href="#">
                        <button id="edit-profile-button" class="edit-button"><i class="fa-solid fa-user-pen"></i> Edit</button>
                        </a>
                        
                            <button class="delete-button" onclick="deletePopup()"><i class="fa-solid fa-user-xmark"></i> Delete</button>
                    </div>

                    <div class="inline-group">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" class="form-control" id="first-name" placeholder="Monica" value="{{ Auth::user()->first_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="middle-name">Middle Name</label>
                            <input type="text" class="form-control" id="middle-name" placeholder="" value="{{ Auth::user()->middle_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Ocampo" value="{{ Auth::user()->last_name }}" readonly>
                        </div>
                    </div>

                    <div class="inline-group">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="form-control" id="course">
                                <option value="{{ Auth::user()->course }}" selected disabled>{{ Auth::user()->course }}</option>
                                <option value="course1">Bachelor of Arts in Broadcasting (BAB)</option>
                                <option value="course2">Bachelor of Science in Accountancy (BSA)</option>
                                <option value="course3">BSA Technology (BSAT) | BSA Information Systems (BSAIS)</option>
                                <option value="course4">Bachelor of Science in Social Work (BSSW)</option>
                                <option value="course5">Bachelor of Science in Information Systems (BSIS)</option>
                                <option value="course6">Computer Technology (CT)</option>
                                <option value="course7">Computer Programming (CP)</option>
                                <option value="course8">Health Care Services (HCS)</option>
                                <option value="course9">International Cookery (IC)</option>
                                <option value="course10">Mass Communication (MC)</option>
                                <option value="course11">Nursing Student (NS)</option>
                                <option value="course12">Office Management (OM)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <select class="form-control" id="batch">
                                <option value="{{ Auth::user()->batch }}" selected disabled>{{ Auth::user()->batch }}</option>
                                <option value="batch1">2006</option>
                                <option value="batch2">2007</option>
                                <option value="batch3">2008</option>
                                <option value="batch4">2009</option>
                                <option value="batch5">2010</option>
                                <option value="batch6">2011</option>
                                <option value="batch7">2012</option>
                                <option value="batch8">2013</option>
                                <option value="batch9">2014</option>
                                <option value="batch10">2015</option>
                                <option value="batch11">2016</option>
                                <option value="batch12">2017</option>
                                <option value="batch13">2018</option>
                                <option value="batch14">2019</option>
                                <option value="batch15">2020</option>
                                <option value="batch16">2021</option>
                                <option value="batch17">2022</option>
                                <option value="batch18">2023</option>
                            </select>
                        </div>
                    </div>

                    <div class="inline-group">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="monicaocampo@student.laverdad.edu.ph" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="mocsss321" value="{{ Auth::user()->username }}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="heading">
                    USER EMPLOYMENT INFORMATION
                </div>
                <div class="panel-btn">
    <div class="inline-group2">
        <div class="form-group">
            <label for="employment">Employment Status</label>
            <select class="form-control" id="employment" name="employment_status">
                <option value="" selected disabled>Choose Employment Status</option>
                <option value="employed" {{ $user->employment && $user->employment->is_employed ? 'selected' : '' }}>Employed</option>
<option value="unemployed" {{ (!$user->employment || !$user->employment->is_employed) ? 'selected' : '' }}>Unemployed</option>

            </select>
        </div>
    </div>
    <div class="inline-group2">
        <div class="form-group">
            <label for="date">Date of First Employment</label>
            <input type="date" class="form-control" id="date" name="date_of_first_employment" value="{{ $user->employment ? $user->employment->date_of_first_employment : '' }}" placeholder="Date of First Employment">
        </div>
        <div class="form-group">
            <label for="date2">Date of Employment</label>
            <input type="date" class="form-control" id="date2" name="date_of_employment" value="{{ $user->employment ? $user->employment->date_of_employment : '' }}" placeholder="Date of Employment">
        </div>
    </div>
    <div class="inline-group2">
        <div class="form-group">
            <label for="industry">Industry</label>
            <input type="text" class="form-control" id="industry" name="industry" value="{{ $user->employment ? $user->employment->industry : '' }}" placeholder="Industry">
        </div>
        <div class="form-group">
            <label for="job">Job Title</label>
            <input type="text" class="form-control" id="job" name="job_title" value="{{ $user->employment ? $user->employment->job_title : '' }}" placeholder="Job Title">
        </div>
    </div>
    <div class="inline-group2">
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" id="company" name="company_name" value="{{ $user->employment ? $user->employment->company_name : '' }}" placeholder="Company">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="company_address" value="{{ $user->employment ? $user->employment->company_address : '' }}" placeholder="Location">
        </div>
    </div>
    <div class="inline-group2">
        <div class="form-group">
            <label for="salary">Salary Per Year (PHP)</label>
            @if($user->employment && $user->employment->annual_salary)
                <?php 
                    $salary_in_peso = number_format($user->employment->annual_salary, 0, ',', ','); 
                ?>
                <input type="text" class="form-control" id="salary" name="annual_salary" value="{{ $salary_in_peso }}" readonly>
            @else
                <input type="text" class="form-control" id="salary" name="annual_salary" value="" placeholder="Salary Per Year (PHP)" readonly>
            @endif
        </div>
    </div>

</div>


                    <div class="heading">
                        USER POST-GRADUATION INFORMATION
                    </div>
                    <div class="panel-btn">
                            <div class="inline-group2">
                                <div class="form-group">
                                    <label for="degree">Degree Status</label>
                                    <input type="text" class="form-control" id="degree" placeholder="Ph.D. in Psychology" value="{{ Auth::user()->degree }}" readonly>
                                </div>
                            </div>
                    </div> 
            </div>
        </div>

        <h3 class="i-name">
            My Job Posted
        </h3>
            
            <div id="container2" class="container2">
                
            </div>

        <h3 class="i-name">
            My Gallery Posted
        </h3>
                
            <div id="container2" class="container2">
            </div>
            <br>

    </section>
</div>

    <div class="popup" id="popup">
        <img src="img/trash.png" alt="">
        <h2>Are you sure you want to delete your account?</h2>
            <div class="inline-group3">
                
                <form id="delete-form" action="{{ route('users.destroy', $userId) }}" method="POST">
                    <button type="button" onclick="closePopup()">NO, CANCEL</button>
                    @csrf
                    @method('DELETE')
                    <button class="sure-button">YES, I'M SURE</button>
                </form>
            </div>
    </div>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
<script>
    // Attach a click event handler to the edit button
    $('#edit-profile-button').click(function() {
        // Implement the edit functionality here
        // For example, you can redirect the user to an edit profile page
        window.location.href = "{{ route('profile.edit') }}"; // Replace 'profile.edit' with your actual route name
    });
</script>
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
</style>