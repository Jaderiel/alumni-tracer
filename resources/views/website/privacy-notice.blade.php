<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link
    href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
    rel="stylesheet"/>
    <script src="site.js"></script>
</head>
<body>

    <header class="combined-header">
        <div class="header-left">
            <div class="contact-info">
                <i class="fas fa-phone"></i>
                <span class="phone-number">+639479998499</span>
                &nbsp;
                <i class="fas fa-envelope"></i> 
                <span class="email">info@laverdad.edu.ph</span>
            </div>
        </div>
        <div class="header-right">
            <div class="social-icons">
                <a href="https://www.facebook.com/lvcc.apalit"><img src="{{ asset('images/website-images/fb.png') }}" alt="Facebook"></a>
                <a href="https://app.laverdad.edu.ph"><img src="{{ asset('images/website-images/google.png') }}" alt="Google"></a>
            </div>
        </div>
    </header>

    <div class="container pri-notice">
        <div class="big-header">
            <div class="logo">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <span class="logo-name">LVCC Alumni 
                    Association</span>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="{{ route('website.show') }}" class="active">Home</a></li>
                    <li><a href="{{ route('about.show') }}">About Us</a></li>
                    <li><a href="{{ route('services.show') }}">Services</a></li>
                </ul>
            </nav>
            <div class="login-button">
                <a href="{{ route('login.show') }}">Login</a>
            </div>
        </div>

        <div class="privacy-section">
            <div class="notice">
                <h2>PRIVACY NOTICE</h2>
                <p>This <u>privacy notice</u> explains the types of personal data we collect from users, how we use that data, and how users can manage their information.</p>

                <div class="data-collection">
                    <h4>DATA COLLECTION</h4>
                    <p class="data-info">The System collects the following types of user information:</p>
                    
                    <ul>
                        <li> <strong>User information:</strong><br> First, middle(optional), and last name, course, batch, email, and any other details provided during registration.</li>
                        <li> <strong>Educational information:</strong><br> Academic history, degrees earned, and courses completed.</li>
                        <li> <strong>Post-graduation information:</strong><br> Details about post-graduation activities, such as further education or employment.</li>
                        <li> <strong>Employment details:</strong><br> Date of first employment, annual salary, industry, job title, company name, and location.
                        </li>
                    </ul>
                </div>

                <div class="controller">
                    <h4>CONTROLLER</h4>
                    <p>The data controller responsible for the collection and processing of your personal information is the Capstone Team. The Capstone Team is responsible for managing and maintaining the System. As the project continues, the team remains actively involved in its development and operation.</p>
                </div>

                <div class="use">
                    <h4>USE AND STORAGE OF DATA</h4>
                    <p>The collected data will be used for analytics purposes only and will be stored securely in our database. We will retain this data until the end of the school year 2023-2024.</p>
                </div>

                <div class="opt-out">
                    <h4>OPTING OUT AND DATA DELETION</h4>
                    <p>Users have the right to opt out of data collection entirely and request the deletion of their stored personal information. To do so, please contact us at <u>jade.admin@gmail.com</u> with your request.</p>
                </div>
                
                <div class="data-security">
                    <h4>DATA SECURITY</h4>
                    <p>We are committed to protecting your personal information and have implemented appropriate technical and organizational measures to safeguard it against unauthorized access, disclosure, alteration, or destruction.</p>
                </div>

                <div class="updates">
                    <h4>UPDATES TO THIS PRIVACY NOTICE</h4>
                    <p>We may update this Privacy Notice from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We encourage users to review this notice periodically for any updates.</p>

                    <p>By using the System, you consent to the collection and use of your personal information as described in this Privacy Notice.
                       <br> <br> If you have any questions or concerns about our privacy practices or this notice, please contact us at <u>jade.admin@gmail.com</u> Thank you!
                       <br> <br>
                       <strong>Last updated:</strong> June 1, 2024
                        </p>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="footer-content">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <p class="footer-name">LVCC Alumni
                    Association</p>
            </div>
            <div>
                <p style="display: inline-block; margin-right: 5px;"><a href="{{ route('privacy-notice.show') }}">Privacy Notice</a> |</p>
                <p style="display: inline-block;"><a href="{{ route('user-guide.show') }}">User Guide</a></p>
            </div>
        </footer>

    </div>
</body>
</html>