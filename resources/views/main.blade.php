<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body class="font-Poppins">
    <div id="sideNavigation" class="side-navigation fixed top-0 h-full z-50 shadow-lg bg-customBlue w-72 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col">
            <div class="flex justify-center p-6 mt-16 lg:mt-2">
                <img class="w-20 lg:w-32 h-20 lg:h-32" src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="">
            </div>
            <div class="flex flex-col mb-16">
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-house"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Dashboard</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-users"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Alumni List</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-calendar-days"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Events</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Jobs</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-image"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Gallery</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Analytics</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Administration</p></div>
                </div>
            </div>
            <div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-user-gear"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Profile</p></div>
                </div>
                <div class="flex text-white hover:bg-customYellow hover:text-customBlue cursor-pointer items-center p-2">
                    <div class="w-1/6 flex justify-center"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <div class="w-5/6 flex justify-start items-center"><p class="text-lg">Logout</p></div>
                </div>
            </div>
        </div>
    </div>
    <div class="head-navigation fixed top-0 w-full z-50 shadow-lg bg-white flex items-center ml-0 lg:ml-72">
        <!-- Burger Menu on the Left -->
        <div class="burger-menu p-4 cursor-pointer lg:hidden" onclick="toggleMenu()" id="headNavigation">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </div>
        <!-- Logo and Title -->
        <div class="ml-4 p-4 font-bold text-2xl alumni-tracking-system">Alumni Tracking System</div>
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
