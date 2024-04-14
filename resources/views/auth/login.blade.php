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
                    <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                </div>
                <div class="input-group">
                    <input type="text" name="middle_name" placeholder="Middle Name">
                </div>
                <div class="input-group">
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="input-group">
                    <select name="course" id="course" required>
                            <option value="" selected disabled>Course</option>
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
                <div class="input-group">
                    <select name="batch" id="batch" required>
                            <option value="" selected disabled>Batch</option>
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
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="input-group">
                    <input type="checkbox" id="termsCheckbox" required>
                    <label for="termsCheckbox">I accept the Terms of Use and Privacy Policy</label>
                </div>
                <button type="submit" class="btn">SIGN UP</button>
            </form>

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
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <input type="text" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" name="password" placeholder="Password" required>
                                    </div>
                                    <button type="submit">Sign In</button>
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