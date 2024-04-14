<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Sign In Form</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
</head>
<body>
<div id="container" class="container">
    <div class="row"> 
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <h1>Create Account</h1>
                    <div class="input-group">
                        <input type="text" placeholder="First Name">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Middle Name">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Last Name">
                    </div>
                    <div class="sign-upp">
                    <div class="input-group">
                        <select name="course" id="course">
                            <option value="" selected disabled>Course</option>
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
                    <div class="input-group">
                        <select name="batch" id="batch">
                            <option value="" selected disabled>Batch</option>
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
                    <div class="input-group">
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="sign-uppp">
                    <div class="input-group">
                        <input type="password" placeholder="Password">
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Confirm password">
                    </div>
                    </div>
                    
                    <div class="input-group">
                        <input type="checkbox" id="termsCheckbox">
                        <label for="termsCheckbox">I accept the Terms of Use and Privacy Policy</label>
                    </div>
                    <br>
                    <button type="submit" class="btn" onclick="openPopup()">SIGN UP</button>
                    
                    <p>
                        <span>
                            Already have an account?
                        </span>
                        <b onclick="toggle()" class="pointer">
                            Sign in here
                        </b>
                    </p>
                </div>
            </div>
        
        </div>
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                    <h1>Sign in</h1>
                    <div class="input-group">
                        <i class='bx bxs-user'></i>
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" placeholder="Password">
                    </div>
                    <br>
                    <form action="dashboard.html">
                        <button type="submit">SIGN IN</button>
                    </form>
                    <p>
                            Forgot password?
                    </p>
                    <p>
                        <span>
                            Don't have an account?
                        </span>
                        <b onclick="toggle()" class="pointer">
                            Sign up here
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row content-row">
        <div class="col align-items-center flex-col">
            <div class="text sign-in">
                <h2>
                    Hello, Alumni!
                </h2>
            </div>

            
            <div class="img sign-in">
    
            </div>
        </div>
        <div class="col align-items-center flex-col">
            <div class="img sign-up">
            
            </div>
            <div class="text sign-up">
                <h2>
                    Join with us!
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="popup" id="popup">
    <img src="img/check.jpg" alt="">
    <h2>Thank you for signing up!</h2>
    <p>For added security, we need to verify your email address. We've sent a verification code to blank@student.laverdad.edu.ph</p>
    <button type="button" onclick="closePopup()">OK</button>
</div>
</body>
<script src="{{ asset('js/login.js') }}"></script>
</html>