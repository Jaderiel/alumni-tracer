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
        @if(Auth::user()->user_type === 'Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">
        Profile Settings
        </h3>
        
        <div class="container">
            <div class="panel">
                <div class="heading">
                    USER INFORMATION
                </div>
                <div class="panel-btn">
                    <div class="row">
                        <a href="profile-edit.html">
                            <button class="edit-button" onclick="openPopup"><i class="fa-solid fa-user-pen"></i> Edit</button>
                        </a>
                        
                            <button class="delete-button" onclick="deletePopup()"><i class="fa-solid fa-user-xmark"></i> Delete</button>
                    </div>
                    <div class="inline-group">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" class="form-control" id="first-name" placeholder="Monica">
                        </div>
                        <div class="form-group">
                            <label for="middle-name">Middle Name</label>
                            <input type="text" class="form-control" id="middle-name" placeholder="Tapion">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Ocampo">
                        </div>
                    </div>
                    <div class="inline-group">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select class="form-control" id="course">
                                <option value="" selected disabled>Bachelor of Science in Accountancy (BSA)</option>
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
                                <option value="" selected disabled>2021</option>
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
                            <input type="email" class="form-control" id="email" placeholder="monicaocampo@student.laverdad.edu.ph">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="mocsss321">
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
                                <select class="form-control" id="employment">
                                    <option value="" selected disabled>Employed</option>
                                    <option value="status1">Employed</option>
                                    <option value="status2">Unemployed</option>
                                </select>
                            </div>
                        </div>
                        <div class="inline-group2">
                                <div class="form-group">
                                    <label for="date">Date of First Employment</label>
                                    <input type="date" class="form-control" id="date" placeholder="09/29/2019">
                                </div>
                                <div class="form-group">
                                    <label for="date2">Date of Employment</label>
                                    <input type="date" class="form-control" id="date2" placeholder="05/25/2022">
                                </div>
                        </div>
                        <div class="inline-group2">
                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" class="form-control" id="industry" placeholder="Technology">
                            </div>
                            <div class="form-group">
                                <label for="job">Job Title</label>
                                <input type="text" class="form-control" id="job" placeholder="UI Designer">
                            </div>
                        </div>
                        <div class="inline-group2">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" id="company" placeholder="XYZ Technical Solutions">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" placeholder="United States">
                            </div>
                        </div>
                        <div class="inline-group2">
                            <div class="form-group">
                                <label for="salary">Salary Per Year</label>
                                <input type="number" class="form-control" id="salary" placeholder="2,700,00">
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
                                    <input type="text" class="form-control" id="degree" placeholder="Ph.D. in Psychology">
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
                <button type="button" onclick="closePopup()">NO, CANCEL</button>
                <a href="login.html">
                <button class="sure-button" onclick="openPopup">YES, I'M SURE</button>
                </a>
            </div>
    </div>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
</html>