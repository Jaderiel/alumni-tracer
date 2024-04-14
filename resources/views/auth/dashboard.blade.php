<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>
    <div id="container" class="container">
    <section id="menu">
        @include('sidenav')
    </section>

    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <i id="menu-btn" class="fa-solid fa-bars"></i>
            </div>
            <div class="profile">
                <i id="notification-btn" class="fa-solid fa-bell"></i>
                <div class="notification-dropdown">
                    <ul>
                        <h4 class="h4-notif">ALL NOTIFICATION</h4> <hr>
                        <li class="notif-info">
                            <div class="left-side">
                                <h4>Monica Ocampo</h4>
                                <p>BSIS</p>
                                <p class="status-posted">Post job hiring!!</p>
                            </div>
                            <div class="right-side">
                                <p>2 hours ago</p>
                            </div>
                        </li>

                        <li class="notif-info">
                            <div class="left-side">
                                <h4>Monica Ocampo</h4>
                                <p>BSIS</p>
                                <p>Post job hiring!!</p>
                            </div>
                            <div class="right-side">
                                <p>2 hours ago</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>            
        </div>
        

        <h3 class="i-name">
            Dashboard
        </h3>
        <p class="i-nameee">Welcome back, {{ Auth::user()->username }}!</p>
        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-briefcase"></i>
                <div>
                    <h3>20</h3>
                    <span>Job Post</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-calendar-days"></i>
                <div>
                    <h3>10</h3>
                    <span>Events</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>800</h3>
                    <span>Alumni</span>
                </div>
            </div>
        </div>

        <div class="board">
            <div class="board-1">
                <table width="100%">
                    <thead>
                        <tr>
                            <td><h2>Forum</h2></td>
                        </tr>
                    </thead>
                </table>
                <hr>

                <div class="forum-section">
                    <div class="left-section">
                        <div class="profile-info">
                            <img src="./img/Picture1.png" alt="Profile Picture">
                            <div class="user-details">
                                <p class="profile-name">Monica Ocampo</p>
                                <p class="profile-course">Bachelor of Science in Information Systems</p>
                            </div>
                        </div>
                    </div> 
                    <div class="center-section">
                        <p>What's on your mind, Monica?</p>
                    </div>
                    <div class="right-section">
                        <button type="submit" class="post-button" onclick="openPopup()">MAKE A POST</button>
                    </div>
                </div>
                <hr>

                <div class="forum-section">
                    <div class="left-section flex items-center justify-between">
                        <div class="profile-info flex items-center">
                            <img src="./img/Picture1.png" alt="Profile Picture" class="w-12 h-12 rounded-full">
                            <div class="user-details">
                                <p class="profile-name">Monica Ocampo</p>
                                <p class="profile-course">Bachelor of Science in Information Systems</p>
                            </div>
                        </div>
                        <i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup2()"></i>
                    </div>
                    
                    <div class="center-section2 flex items-center">
                        <p class="mr-2">BATCH 2023-2024</p>
                        <img src="./img/bsis-sample-3.jpg" alt="Image" class="image-posted"> 
                    </div>

                    <div class="forum-section2">
                        <table>
                        <thead>
                            <tr>
                                <td><i class="fa-regular fa-thumbs-up"></i></td>
                                <td><i class="fa-solid fa-comment-dots"></i></td>
                            </tr>
                        </thead>
                        </table>
                    </div>

                </div>

                <div class="forum-section">
                    <div class="left-section flex items-center justify-between">
                        <div class="profile-info flex items-center">
                            <img src="./img/Picture1.png" alt="Profile Picture" class="w-12 h-12 rounded-full">
                            <div class="user-details">
                                <p class="profile-name">Monica Ocampo</p>
                                <p class="profile-course">Bachelor of Science in Information Systems</p>
                            </div>
                        </div>
                        <i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup2()"></i>
                    </div>
                    
                    <div class="center-section3">
                        <div class="flex items-center">
                            <img src="./img/update.jpg" alt="Image" class="image-update small-image">
                            <p class="mr-2">Update POST-GRADUATION INFORMATION</p>
                        </div>
                        <p class="post-grad">Ph.D. in Psychology</p>
                    </div>

                    <div class="forum-section2">
                        <table>
                        <thead>
                            <tr>
                                <td><i class="fa-regular fa-thumbs-up"></i></td>
                                <td><i class="fa-solid fa-comment-dots"></i></td>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body-announcement">
                        <div class="card-body">
                            <h4 class="text-center">Upcoming Events</h4>
                        </div>
                    </div>
                    
                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">ICT WEEK</p>
                            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nisi cumque deleniti, eum temporibus nostrum eligendi sint natus?</P>
                        </div>
                    </div>
    
                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">ICT WEEK</p>
                            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque nisi cumque deleniti, eum temporibus nostrum eligendi sint natus?</P>
                        </div>
                    </div> <br>
                    </div>
                </div>
        </div>
    </section>
</div>

    <div class="popup" id="popup">
        <div class="create">
            <h3>Create Post</h3>
            <i class="fa-solid fa-circle-xmark" onclick="closePopup()"></i>
        </div> 
        <hr>
            <div class="left-section2">
                <div class="profile-info2">
                    <img src="./img/Picture1.png" alt="Profile Picture">
                    <div class="user-details2">
                        <p class="profile-name2">Monica Ocampo</p>
                        <p class="profile-course">Bachelor of Science in Information Systems</p>
                    </div>
                </div>
            </div> 
            <div class="center-section2">
                <textarea rows="3" placeholder="What's on your mind, Monica?"></textarea>
            </div>
            <div class="add">
                <h4>Add to your post</h4>
                <img src="./img/add-image.jpg" alt="add-image">
            </div>
            <button type="button" onclick="closePopup()">POST</button>
        </div>

        <div class="popup2" id="popup2">
            <div class="edit">
                <h3>Edit Post</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closePopup2()"></i>
            </div> 
            <hr>
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/Picture1.png" alt="Profile Picture">
                        <div class="user-details2">
                            <p class="profile-name2">Monica Ocampo</p>
                            <p class="profile-course">Bachelor of Science in Information Systems</p>
                        </div>
                    </div>
                </div> 
                <div class="center-section2">
                    <textarea rows="3" placeholder="What's on your mind, Monica?"></textarea>
                </div>
                <div class="add">
                    <h4>Add to your post</h4>
                    <img src="./img/add-image.jpg" alt="add-image">
                </div>
                <button type="button" onclick="closePopup2()">SAVE</button>
            </div>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>

</body>
<script src="{{ asset('js/dashboard.js') }}"></script>
</html>