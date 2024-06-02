<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Website About</title>
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
                    <li><a href="{{ route('about.show') }}" class="active">About Us</a></li>
                    <li><a href="{{ route('services.show') }}">Services</a></li>
                </ul>
            </nav>
            <div class="login-button">
                <a href="{{ route('login.show') }}">Login</a>
            </div>
        </div>

        <div class="about-alumni">
            <h2>ABOUT US</h2>
            <p>Step into our 'About Us' page, where you'll discover what drives us forward. Explore our mission, our clear vision, and the values that define us, along with what makes this system helpful for the alumni community to stay connected. Learn about the people who started LVCC and those who carry its legacy today. Join us as we take you through the story of LVCC – where tradition meets progress, and what has kept our foundation strong until now.</p>
        </div>
        
        <div class="mission-vision-phil">
            <div class="mission-vision-philosophy">
                <div class="vision">
                    <h3>Mission</h3>
                    <p>To cultivate lasting connection among LVCC alumni, promoting support and alignment with institution's core values.</p>
                </div>
                <div class="philosophy">
                    <h3>Vision</h3>
                    <p>A strong LVCC Alumni network, embracing academic excellence and moral values.</p>
                </div>
            </div>
        </div>
        
        <div class="person-behind">
            <div class="title-person">
                <h3>PERSONS BEHIND LVCC</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="column founder">
                <img src="{{ asset('images/website-images/Bro.Eli.jpg') }}" alt="Image">
                <h3>Bro. Eliseo F. Soriano</h3>
                <p class="role">FOUNDING CHAIRMAN</p>
            </div>
            <div class="column">
                <p><strong>Bro. Eli</strong>, the esteemed founder of La Verdad Christian College, envisioned a world where education is not a privilege but a right for every deserving individual. His unwavering commitment to providing quality education to the less fortunate echoes through the halls of LVCC, continuing to inspire generations even after his passing. His belief in the biblical mandate to help those in need led to the establishment of LVCC, reminding us that education is not just a gift from man but a blessing from above.</p>
            </div>
        </div>
        
        <div class="row row-1">
            <div class="column">
                <p><strong>Dr. Daniel</strong>, the president of La Verdad Christian College, carries forward the torch lit by Bro. Eli Soriano, ensuring that the institution thrives and provides countless students with the opportunity to pursue their dreams. In the footsteps of his predecessor, Bro. Daniel Razon remains committed to the principles of free and quality education, upholding the vision of LVCC as a beacon of hope. His stewardship of LVCC goes beyond mere administration; it is a labor of love and service to the community, reflecting his deep-seated commitment to making education accessible to all.</p>
            </div>
            <div class="column president">
                <img src="{{ asset('images/website-images/Bro.Daniel.jpg') }}" alt="Image">
                <h3>Dr. Daniel S. Razon</h3>
                <p class="role-1">PRESIDENT</p>
            </div>
        </div>
        
        <div class="img-container">
            <img src="{{ asset('images/website-images/ED.png') }}"  alt="" >
        </div>

        <footer class="footer">
            <div class="footer-content">
                <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="Logo">
                <p class="footer-name">LVCC Alumni 
                    Association</p>
            </div>
            <p><a href="{{ route('privacy-notice.show') }}">Privacy Notice</a></p>
        </footer>
    </div>
   
</body>
</html>