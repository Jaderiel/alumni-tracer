<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approvals</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
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

    <h3 class="i-name">Edit Profile</h3>

        <div class="heading">
            USER INFORMATION
        </div>

    <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')
    
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

    <div class="inline-group">
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
            <select class="form-control" id="batch" name="batch"> <!-- Added name attribute -->
                <option value="{{ $user->batch }}" selected disabled>{{ $user->batch }}</option>
                <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
            </select>
        </div>
    </div>

                    <div class="inline-group">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                        </div>
                    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a href="{{ route('profile') }}" class="btn btn-primary">Back</a>
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
</style>