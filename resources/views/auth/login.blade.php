<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}"> -->
</head>
<body class="w-full">
<div id="container" class="container">
    <div class="row"> 
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <h1>Create Account</h1>
                    <form id="registerForm">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="first_name" placeholder="First Name" required>
                            <span class="required-asterisk">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="middle_name" placeholder="Middle Name">
                        </div>
                        <div class="input-group">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                            <span class="required-asterisk">*</span>
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
                                <option value="Associate in Computer Technology">Associate in Computer Technology (ACT)</option>
                                <option value="Computer Technology">Computer Technology (CT)</option>
                                <option value="Computer Programming">Computer Programming (CP)</option>
                                <option value="Health Care Services">Health Care Services (HCS)</option>
                                <option value="International Cookery">International Cookery (IC)</option>
                                <option value="Mass Communication">Mass Communication (MC)</option>
                                <option value="Nursing Student">Nursing Student (NS)</option>
                                <option value="Office Management">Office Management (OM)</option>
                            </select>
                            <span class="required-asterisk">*</span>
                        </div>

                        <div class="input-group">
                            <select name="batch" id="batch" required>
                                <option value="" selected disabled>Batch</option>
                                @for ($year = date('Y'); $year >= 2006; $year--)
                                    @php
                                        $nextYear = $year + 1;
                                    @endphp
                                    <option value="{{ $year }} - {{ $nextYear }}">{{ $year }}-{{ $nextYear }}</option>
                                @endfor
                            </select>
                            <span class="required-asterisk">*</span>
                        </div>

                        <div class="input-group">
                            <input type="email" name="email" id="email" placeholder="Email" required>
                            <span class="required-asterisk">*</span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="username" placeholder="Username" required>
                            <span class="required-asterisk">*</span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" placeholder="Password" required>
                            <span class="required-asterisk">*</span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                            <span class="required-asterisk">*</span>
                        </div>
                        <div class="input-group">
                            <input type="checkbox" id="termsCheckbox" required>
                            <label for="termsCheckbox">I accept the <span id="termsLink">Terms of Use and Privacy Policy</span></label>
                        </div>
                        <button type="submit" class="btn" id="signupBtn">SIGN UP</button>
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
                <img src="images/website-images/lv-logo.png" alt="Logo" class="logo">
                    <h1>Sign in</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="show-error">
                                {{ $errors->first() }}
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
                    <div style="display: flex; gap: 10px; justify-content: center; margin-top: 5px">
                        <p><a href="{{ route('password.request') }}" style="text-decoration: none; color: gray;">Forgot password?</a></p>
                        <p>|</p>
                        <p><a href="{{ route('ver.show') }}" style="text-decoration: none; color: gray;">Account Verification</a></p>
                    </div>
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
    <h2>Thank you for signing up!</h2>
    <p>For added security, we need to verify your email address. We've sent a verification code to <span id="userEmail"></span></p>
    <button type="button" onclick="closePopup()">OK</button>
</div>

<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <span class="close">&times;</span>
    <h2><strong>TERMS OF USE AND PRIVACY POLICY</strong></h2>

    <ul>
        <li>
            <h4><strong>Acceptance of Terms</strong></h4>
            <p>By accessing or using the LVCC Alumni Tracking System, you agree to be bound by these Terms and Conditions. If you do not agree with these Terms and Conditions, please do not use the System.</p>
        </li>
        <li>
            <h4><strong>Description of Service</strong></h4>
            <p>The System provides a platform for alumni to maintain their contact information, connect with other alumni, and receive updates and notifications from their alma mater.</p>
        </li>
        <li>
            <h4><strong>User Registration</strong></h4>
            <p>To access certain features of the System, you may be required to register and provide accurate and complete information about yourself. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
        </li>
        <li>
            <h4><strong>Account Management</strong></h4>
            <p>Upon registration, users acknowledge that account deletion is not permitted. This policy ensures the accuracy of alumni records and complies with institutional data retention protocols.</p>
        </li>
        <li>
            <h4><strong>Use of Information</strong></h4>
            <p>The information you provide to the System will be used to facilitate alumni network, communication, and engagement activities. Your information will not be shared with third parties without your consent, except as required by law, including compliance with the <i>Data Privacy Law of 2021 (Republic Act No. 10173)</i>, which governs the collection, processing, and protection of personal data.</p>
        </li>
        <li>
            <h4><strong>Prohibited Conduct</strong></h4>
            <p>You agree not to use the system for any unlawful or prohibited activities, including posting harmful or objectionable content.</p>
        </li>
        <li>
            <h4><strong>Modifications to Terms</strong></h4>
            <p>The System owner reserves the right to modify or revise these <u>Terms and Conditions</u> at any time without prior notice. Your continued use of the System following any such changes constitutes your acceptance of the revised Terms and Conditions.</p>
        </li>
        <li>
            <h4><strong>Contact Information</strong></h4>
            <p>If you have any questions or concerns about these Terms and Conditions, please contact us at <a href="mailto:jade.admin@gmail.com">jade.admin@gmail.com</a>. Thank you!</p>
        </li>
    </ul>
</div>

</div>

    <div id="successMessage" class="success-popup">
        Registration successful! Please wait for the Admin to verify your account.
    </div>

    <div id="errorMessage" class="error-popup">
        Registration failed. Please check your input and try again.
    </div>

</body>
<script src="{{ asset('js/login.js') }}"></script>
<script>
    // Get the modal element
    var modal = document.getElementById("myModal");

    // Get the close button element
    var closeButton = document.getElementsByClassName("close")[0];

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Event listener for the close button
    closeButton.addEventListener("click", closeModal);

    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth <= 768) {
            window.location.href = "{{ route('mobileLogin.show') }}";
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            window.location.href = "{{ route('mobileLogin.show') }}";
        }
    });

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route("register") }}',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect_url;
                } else {
                    $('#errorMessage').text('Unexpected response from the server.').fadeIn().delay(3000).fadeOut();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "";
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + "\n";
                    });
                    $('#errorMessage').text(errorMessage).fadeIn().delay(3000).fadeOut();
                } else {
                    $('#errorMessage').text('Registration failed. Please check your input and try again.').fadeIn().delay(3000).fadeOut();
                }
            }
        });
    });
});
</script>

</html>

<style>
    .success-popup, .error-popup {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .success-popup {
        background-color: #4CAF50;
        color: white;
    }

    .error-popup {
        background-color: #F44336;
        color: white;
    }
</style>
