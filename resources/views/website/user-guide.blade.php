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
                <a href="{{ route('login.show') }}">Sign in</a>
            </div>
        </div>

        <iframe src="http://heyzine.com/flip-book/615d393007.html#page/4" width="100%" height="600px">
        </iframe>
       


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
<style>
    .iframe {
  border: none;
  background-color: transparent;
  outline: none;
}

</style>
</html>