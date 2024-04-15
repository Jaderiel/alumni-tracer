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
    @if(Auth::user()->user_type === 'Admin')
        @include('components.admin-sidenav')
    @else
        @include('components.sidenav')
    @endif
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
                    <h3>{{ $verifiedAlumniCount }}</h3>
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
                            @if (Auth::user()->profile_pic)
                                <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture" class="w-8 h-8 rounded-full"> <!-- Use the user's profile picture -->
                            @else
                                <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" class="w-8 h-8 rounded-full"> <!-- Use the placeholder image -->
                            @endif
                            <div class="user-details">
                                <p class="profile-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                <p class="profile-course">{{ Auth::user()->course }}</p>
                            </div>
                        </div>
                    </div> 
                    <div class="center-section">
                        <p>What's on your mind, {{ Auth::user()->username }}?</p>
                    </div>
                    <div class="right-section">
                        <button type="submit" class="post-button" onclick="openPopup()">MAKE A POST</button>
                    </div>
                </div>
                <hr>
            @foreach($forumPosts as $post)
                <div class="forum-section">
                    <div class="left-section flex items-center justify-between">
                        <div class="profile-info flex items-center">
                        @if ($post->user->profile_pic)
                            <img src="{{ $post->user->profile_pic }}" alt="Profile Picture" class="w-8 h-8 rounded-full"> <!-- Use the user's profile picture -->
                        @else
                            <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" class="w-8 h-8 rounded-full"> <!-- Use the placeholder image -->
                        @endif
                            <div class="user-details">
                                <p class="profile-name">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                                <p class="profile-course">{{ $post->user->course }}</p>
                            </div>
                        </div>
                        <i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup2()"></i>
                    </div>
                    
                    <div class="center-section2 flex items-center">
                        <p class="mr-2">{{ $post->caption }}</p>
                        @if ($post->media_url)
                            <img src="{{ $post->media_url }}" alt="Image" class="image-posted"> <!-- Use the user's profile picture -->
                        @else
                            <p></p> <!-- Use the placeholder image -->
                        @endif
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
            @endforeach
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
        <i class="fa-solid fa-circle-xmark" id="clearButton" onclick="closePopup()"></i>
    </div> 
    <hr>
    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="left-section2">
        <div class="profile-info2">
            <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture">
            <div class="user-details2">
                <p class="profile-name2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <p class="profile-course">{{ Auth::user()->course }}</p>
            </div>
        </div>
    </div> 
    
        
        <div class="center-section2">
            <textarea name="caption" rows="3" placeholder="What's on your mind, {{ Auth::user()->username }}?"></textarea>
        </div>
        <div class="add">
            <!-- <h4>Add to your post</h4> -->
            <input type="file" name="image" accept="image/*">
            <!-- Here you can add additional functionality for adding more to the post if needed -->
        </div>
        <button type="submit">POST</button>
    </form>
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