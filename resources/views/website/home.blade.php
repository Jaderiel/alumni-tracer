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

    <div class="container">
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

        <div class="bg-container">
            <div class="left-content">
                <h2>Stay connected with <br> your co-alumni</h2>
                <p>Welcome to our LVCC Alumni Tracking System, where you can effortlessly reconnect with former classmates, network with professionals in your field, and stay updated on alumni events and opportunities. Join us as we continue to support, inspire, and empower each other long after graduation.</p>
                <a href="{{ route('login.show') }}"><button>Connect now..</button></a>
            </div>
            <div class="right-content">
                <img src="{{ asset('images/website-images/network_bg.png') }}" alt="Image">
            </div>
        </div>

        <div class="values">
            <div class="val-box" title="Total Job Opportunities">
                <i class="fa-solid fa-briefcase"></i>
                <h3 id="jobOp">{{ $jobCount }}</h3>
                <p>Job Posted</p>
            </div>
            <div class="val-box" title="Total Event Posted">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 id="eventPos">{{ $eventCount }}</h3>
                <p>Event Posted</p>
            </div>
            <div class="val-box" title="Total Alumni Members">
                <i class="fa-solid fa-users"></i>
                <h3 id="alumniMembers">{{ $verifiedAlumniCount }}</h3>
                <p>Alumni Members</p>
            </div>
        </div>
        

        <div class="offers">
            <h2>OUR ALUMNI TRACKING SYSTEM OFFERS</h2>
            <div class="offer-container">
                <div class="offer">
                    <img src="{{ asset('images/website-images/bsis-sample-4.jpg') }}" alt="Offer 1">
                    <h3 class="offer-title">LVCC ALUMNI CONNECT</h3>
                </div>
                <div class="offer">
                    <img src="{{ asset('images/website-images/bsis-sample.jpg') }}" alt="Offer 2">
                    <h3 class="offer-title">JOB OPPORTUNITIES</h3>
                </div>
                <div class="offer">
                    <img src="{{ asset('images/website-images/bsis-corndog.jpg') }}" alt="Offer 3">
                    <h3 class="offer-title">UPCOMING EVENTS</h3>
                </div>
            </div>

                <a href="{{ route('services.show') }}">
                    <button class="button-more"> READ MORE</button>
                </a>
        </div>

        <div class="testimonials">
            <h2>OUR TESTIMONIALS</h2>
            <div class="testimonial-row">
                <div class="testimonial-column founder">
                    <img src="{{ asset('images/website-images/sir_ron_tes.jpg') }}" alt="Image">
                </div>
                <div class="testimonial-column">
                    <p>"As an alumnus of La Verdad Christian College, Inc., I'm grateful for the transformative education and lifelong values instilled in me. Even after graduation, I still enjoy the vibrant events that bring alumni together, fostering connections and keeping us engaged in the college's mission of excellence and service." </p>
                    <h3>Mr. Ronmar Calingasan</h3>
                    <p class="pos">Alumni | BSIS | Batch 2019 </p>
                    
                    
                </div>
            </div>
            
            <div class="testimonial-row row-1">
                <div class="testimonial-column ma" >
                    <p class="pi">LVCC is very welcoming to its alumni, even when important events come up. Alumni can freely attend and participate as long as they inform their coordinators or program heads.

                        In my case, as a BSIS alumna, I have been invited to speak about our Capstone research project during ICT Week celebration.
                        
                        I really appreciate the effort they always put forth whenever there are events in our program, or if there are charity events like feeding programs, free stores, and medical missions. Alumni are free to join these charity events. We also have our souvenir polo shirts. With all of these, all I can say is, "Thanks be to God for being part of this institution."
                        
                        As they say, "Once la Verdarianz, always La Verdarianz!"</p>
                    <h3>Ms. Angel Blaze Candinato</h3>
                    <p class="pos">Alumni | BSIS | Batch 2023 </p>
                </div>
                <div class="testimonial-column president">
                    <img src="{{ asset('images/website-images/mam_angel.jpg') }}" alt="Image">
                </div>
            </div>
            <!-- <div class="testimonial testimonial-left">
                <img src="./img/sir_ron_tes.jpg" alt="Testimonial 1">
                <h3 class="title">BEST SCHOOL</h3>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="testimonial testimonial-right">
                <img src="../img/bsis-sample-4.jpg" alt="Testimonial 1">
                <h3 class="title">BEST SCHOOL</h3>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="testimonial testimonial-left">
                <img src="../img/bsis-sample-3.jpg" alt="Testimonial 1">
                <h3 class="title">BEST SCHOOL</h3>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div> -->
        </div>
        
        <div class="video-container">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/YenHDgQ-srw?si=KAc-DWJCKt2VCO5B" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <!-- <iframe src="https://www.youtube.com/embed/VIDEO_ID_HERE" frameborder="0" allowfullscreen></iframe> -->
        </div>

        <footer class="footer">
            <div class="footer-content">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <p class="footer-name">LVCC Alumni 
                    Association</p>
                <a href="{{ route('privacy-notice.show') }}"><p>Privacy Notice</p></a>
            </div>
            <p><a href="privacy-notice.html">Privacy Notice</a></p>
        </footer>
    </div>
</body>
</html>