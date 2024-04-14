<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni List Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <section id="menu">
        <!-- Include the appropriate side navigation -->
        @if(Auth::user()->user_type === 'Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">

            <div class="navigation">
                <div class="n1">
                    <i id="menu-btn" class="fa-solid fa-bars"></i>
                </div>
                <div class="profile">
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>

            <h3 class="i-name">
                Alumni List
            </h3>

        <div class="find">
            <div class="search-course">
                <select name="course" id="course">
                    <option value="" selected disabled>COURSE NAME</option>
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
            <div class="search-batch">
                <select name="batch" id="batch">
                    <option value="" selected disabled>BATCH YEAR</option>
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
            <div class="search">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
        </div>

        <div class="board-list">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>User Type</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($verifiedAlumni as $user)
                    <tr>
                        <td class="user">
                            <div class="user-info">
                                <h5>{{ $user->username }}</h5>
                            </div>
                        </td>
                        <td class="email">{{ $user->email }}</td>
                        <td class="user-type">{{ $user->user_type }}</td>
                        <td class="action">
                            <a href="#" class="button">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <script>
        // JavaScript code if needed
    </script>
</body>
</html>
