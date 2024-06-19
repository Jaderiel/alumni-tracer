<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Website Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
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

    <div class="container">
        <div class="big-header">
            <div class="logo">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <span class="logo-name">LVCC Alumni 
                    Association</span>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="{{ route('website.show') }}">Home</a></li>
                    <li><a href="{{ route('about.show') }}">About Us</a></li>
                    <li><a href="{{ route('services.show') }}" class="active">Services</a></li>
                </ul>
            </nav>
            <div class="login-button">
                <a href="{{ route('login.show') }}">Login</a>
            </div>
        </div>

        <div class="services">
            <div class="service-adj">
                <h2>OUR SERVICES</h2>
                 <P>Discover our range of features designed to enhance alumni engagement and support educational institutions. From efficient directory access to networking tools, our platform connects graduates with opportunities and strengthens alumni-school relationships.</P>
            </div>
        </div>
        
        <div class="div-feature">
            
        </div>
        <div class="feature">
            <h2>SOME FEATURES</h2>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/forum-icon.png') }}" alt="" title="FORUM">
                </div>
                <div class="right">
                    <p>Share memories and achievements to inspire, not to boast. This space allows alumni to reminisce, share accomplishments, and inspire one another through their experiences.</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/event-icon.png') }}" alt="" title="EVENT">
                </div>
                <div class="right">
                    <p>Easily notify alumni of events, announce upcoming events, and allow alumni to accept invitations through the system.</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/annmnt-icon.png') }}" alt="" title="ANNOUNCEMENT">
                </div>
                <div class="right">
                    <p>Provide important updates to the alumni community. Keep alumni informed about significant news, developments, and opportunities related to their alma mater</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/alumni-icon.png') }}" alt="" title="ALUMNI COMMUNITY">
                </div>
                <div class="right">
                    <p>Enhance networking and communication by organizing alumni by courses and batches. Access a comprehensive alumni directory for targeted connections and networking.</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/job-iconn.png') }}" alt="" title="JOB OPPORTUNITIES">
                </div>
                <div class="right">
                    <p>Connect alumni with job openings and career opportunities. Explore job listings offered to alumni, with options to both apply for positions and post job opportunities within the community.</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/gallery-icon.png') }}" alt="" title="GALLERY">
                </div>
                <div class="right">
                    <p>Share memories from college days, organized by courses. Browse through a collection of photos and memories from alumni's college experiences, conveniently grouped by courses.
                    </p>
                </div>
            </div>

            <div class="wrapper">
                <div class="left">
                    <img src="{{ asset('images/website-images/analytics-icon.png') }}" alt="" title="ANALYTICS">
                </div>
                <div class="right">
                    <p>Provide insights into the alumni community's size, growth, and engagement. Gain valuable data on the number of alumni within the system, graduation trends, event participation rates, and other key metrics to inform strategic decisions and measure community engagement.
                    </p>
                </div>
            </div>
        </div>

        <div class="row-service">
            <div class="column-service">
                <img src="{{ asset('images/website-images/system-cover.png') }}" alt="Image">
            </div>
            <div class="column-service p">
                <p>From accessing a detailed dashboard to browsing through our extensive alumni list, discovering job opportunities, viewing memorable moments in our gallery, engaging in meaningful discussions on our forum, and staying updated with exciting event announcements – our platform offers it all. <strong>Join us now!</strong> </p>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-content">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <p class="footer-name">LVCC Alumni
                    Association</p>
            </div>
            <div>
                <p style="display: inline-block; margin-right: 5px;"><a href="{{ route('privacy-notice.show') }}">Privacy Notice</a></p>
                <p style="display: inline-block;"><a href="{{ route('user-guide.show') }}">User Guide</a></p>
            </div>
        </footer>

    </div>
</body>
</html>