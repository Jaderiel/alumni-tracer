<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="font-Poppins mb-16">
    <div id="sideNavigation" class="side-navigation fixed top-0 h-full z-50 shadow-lg bg-customBlue w-72 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col">
            <div class="flex justify-center p-6 mt-16 lg:mt-2">
                <img class="w-20 lg:w-32 h-20 lg:h-32" src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="">
            </div>
            <div class="flex flex-col mb-16">
                <a href="{{ route('dashboard') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-house text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Dashboard</p></div>
                    </div>
                </a>
                <a href="{{ route('alumni-list') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-users text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Alumni List</p></div>
                    </div>
                </a>
                <a href="{{ route('events') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-calendar-days text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Events</p></div>
                    </div>
                </a>
                <a href="{{ route('jobs') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-briefcase text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Jobs</p></div>
                    </div>
                </a>
                <a href="{{ route('gallery') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-image text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Gallery</p></div>
                    </div>
                </a>
                <a href="{{ route('analytics') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-chart-line text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Analytics</p></div>
                    </div>
                </a>
                @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
                <a href="{{ route('administration.show') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-user-tie text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Administration</p></div>
                    </div>
                </a>
                @endif
            </div>
            <div class="mb-16">
                <a href="{{ route('user-profile') }}">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-user-gear text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Profile</p></div>
                    </div>
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                        <div class="w-1/6 flex justify-center"><i class="fa-solid fa-right-from-bracket text-sm p-0 m-0"></i></div>
                        <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Logout</p></div>
                    </div>
                </a>
            </div>
            <div class="flex justify-center cursor-pointer">
                <a href="{{ route('privacy-notice.show') }}"><p class="text-white text-xs hover:text-customYellow">Privacy Notice</p></a>
            </div>
        </div>
    </div>
    <div class="head-navigation fixed top-0 w-full z-50 shadow-lg bg-white flex items-center ml-0 lg:ml-72 pr:0 lg:pr-72 justify-center">
        <!-- Burger Menu on the Left -->
        <div class="burger-menu p-4 cursor-pointer lg:hidden" onclick="toggleMenu()" id="headNavigation">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </div>
        <!-- Logo and Title -->
        <div class="ml-4 p-4 font-bold text-sm lg:text-2xl alumni-tracking-system">LVCC Alumni Tracking System</div>
        <!-- Side Navigation -->
    </div>

    <script>
        function toggleMenu() {
            const sideNav = document.getElementById('sideNavigation');
            const headNav = document.getElementById('headNavigation');

            sideNav.classList.toggle('-translate-x-full');
            sideNav.classList.toggle('translate-x-0');

            // headNav.classList.toggle('pt-72');
        }
    </script>
</body>
</html>
