<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <section id=menu>
    @if(Auth::user()->user_type === 'Admin')
        @include('components.admin-sidenav')
    @else
        @include('components.sidenav')
    @endif
    </section>

    <section id="interface">

    @include('components.headernav')

    <h3 class="i-name">
        <a href="{{ route('user-profile') }}" class="back-link"><i class="fas fa-arrow-left"></i></a>Profile Settings
        </h3>

    <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

    <div class="heading">
        USER INFORMATION
    </div>
    
    <div class="user-info">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
        </div>


        <div class="form-group">
                <label for="course">Course</label>
                <select class="form-control" id="course" name="course"> <!-- Added name attribute -->
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
        <div class="form-group">
                <label for="batch">Batch</label>
                <select name="batch" id="batch" required>
                    <option value="{{ $user->bacth }}">{{ $user->batch }}</option>
                        @for ($year = date('Y'); $year >= 2006; $year--)
                        @php
                        $nextYear = $year + 1;
                        @endphp
                        <option value="{{ $year }} - {{ $nextYear }}">{{ $year }}-{{ $nextYear }}</option>
                        @endfor
                </select>
        </div>
        

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
        </div>
    </div>

        <div class="heading">
            USER EMPLOYMENT INFORMATION
        </div>
        
        <div class="user-info">
            <div class="form-group">
                <label for="employment">Employment Status</label>
                <select class="form-control" id="employment" name="employment_status">
                    <option value="employed" {{ $user->employment && $user->employment->is_employed ? 'selected' : '' }}>Employed</option>
                    <option value="unemployed" {{ (!$user->employment || !$user->employment->is_employed) ? 'selected' : '' }}>Unemployed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date of First Employment</label>
                <input type="date" class="form-control" id="date" name="date_of_first_employment" value="{{ $user->employment ? $user->employment->date_of_first_employment : '' }}">
            </div>

            <div class="form-group">
                <label for="date2">Date of Employment</label>
                <input type="date" class="form-control" id="date2" name="date_of_employment" value="{{ $user->employment ? $user->employment->date_of_employment : '' }}">
            </div>

            <div class="form-group">
                <label for="industry">Industry</label>
                <input type="text" class="form-control" id="industry" name="industry" value="{{ $user->employment ? $user->employment->industry : '' }}">
            </div>

            <div class="form-group">
                <label for="job">Job Title</label>
                <input type="text" class="form-control" id="job" name="job_title" value="{{ $user->employment ? $user->employment->job_title : '' }}">
            </div>

            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company_name" value="{{ $user->employment ? $user->employment->company_name : '' }}">
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="company_address" value="{{ $user->employment ? $user->employment->company_address : '' }}">
            </div>

            <div class="form-group">
                <label for="salary">Salary Per Year</label>
                <input type="number" class="form-control" id="salary" name="annual_salary" value="{{ $user->employment ? $user->employment->annual_salary : '' }}">
            </div>
        </div>


        <div class="heading">
            USER POST-GRADUATION INFORMATION
        </div>
                    
        <div class="user-info">
            <div class="form-group">
                <label for="degree">Degree Status</label>
                <input type="text" class="form-control" id="degree" name="degree" value="{{ $user->degree }}">
            </div>
        </div>

        <button type="submit" class="btn-save">Save Changes</button>
    </form>
</section>

</body>
</html>

<style>
    .heading {
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        background: #162F65;
        text-align: start;
        padding: 10px 15px;
    }
    .btn-save {
        background-color: #4CAF50; 
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin: 20px
    }
    .btn-save:hover {
        background-color: #45a049;
    }
    .back-link {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
    }

    .back-link:hover {
        color: #000; 
    }
    .user-info {
        display: flex;
        flex-direction: column;
        background-color: white;
        padding: 20px;
        gap: 5px
    }
</style>