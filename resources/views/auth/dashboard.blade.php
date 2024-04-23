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
        @include('components.headernav')
        

        <h3 class="i-name">
            Dashboard
        </h3>
        <p class="i-nameee">Welcome back, {{ Auth::user()->username }}!</p>
        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-briefcase"></i>
                <div>
                    <h3>{{ $jobCount }}</h3>
                    <span>Job Post</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-calendar-days"></i>
                <div>
                    <h3>{{ $eventCount }}</h3>
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
                        <button type="submit" class="post-button" onclick="openPopup0()">MAKE A POST</button>
                    </div>
                </div>
                <hr>
                
            @foreach($forumPosts->sortByDesc('created_at') as $post)
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
                        @if(auth()->check() && (auth()->user()->id == $post->user->id || auth()->user()->user_type == 'Admin'))
                        <i class="fas fa-ellipsis-v text-gray-600 ml-" style="padding-left: 100px" onclick="openPopup2('{{ $post->id }}', '{{ $post->user->first_name }} {{ $post->user->last_name }}', '{{ $post->caption }}', '{{ $post->user->profile_pic }}', '{{ $post->media_url }}', '{{ $post->user->course }}')"></i>
                        @endif
                    </div>
                    
                    <div class="center-section2 flex items-center">
                        <p class="mr-2">{{ $post->caption }}</p>
                        @if ($post->media_url)
                            <img src="{{ $post->media_url }}" alt="Image" class="image-posted"> <!-- Use the user's profile picture -->
                        @else
                            <p></p> <!-- Use the placeholder image -->
                        @endif
                        <div class="likers" onclick="openPopup3()">
                            <img src="http://127.0.0.1:5500/user/img/like.png" alt="Image" class="like"> 
                            <p id="yuzer">Melanie Lopez and 2 others</p>
                        </div>
                    </div>

                    <div class="forum-section2">
                        <table>
                        <thead>
                            <tr>
                                <td><i id="thumbsUpIcon" class="fa-solid fa-thumbs-up"></i></td>
                                <td class="comment-button" onclick="openPopup4()"><i class="fa-solid fa-comment-dots"></i></td>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            @endforeach

            {{ $forumPosts->links('components.pagination') }}
            </div>
            
            
            @include('components.announcements')

    </section>
</div>

<div class="popup0" id="popup0">
    <div class="create">
        <h3>Create Post</h3>
        <i class="fa-solid fa-circle-xmark" id="clearButton" onclick="closePopup0()"></i>
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

        @include('popups.update-post')

        <div class="popup3" id="popup3">
            <div class="like">
                <button class="btn">
                    <img src="http://127.0.0.1:5500/user/img/like.png" alt="Image">
                    <p>3</p>
                </button>
                <i class="fa-solid fa-circle-xmark" onclick="closePopup3()"></i>
            </div> 
            <h3>You can see the total number of reactions to your post.</h3>
            <div class="panel2">
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/mel.jpg" alt="Profile Picture">
                        <div class="user-details2">
                            <p class="profile-name2">Melanie Lopez</p>
                            <p class="profile-course2">Bachelor of Science in Information Systems (BSIS)</p>
                        </div>
                    </div>
                </div> 
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/jeyd.jpg" alt="Profile Picture">
                        <div class="user-details2">
                            <p class="profile-name2">Jade Riel Abuela</p>
                            <p class="profile-course2">Bachelor of Arts in Broadcasting (BAB)</p>
                        </div>
                    </div>
                </div> 
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/gaspar.jpg" alt="Profile Picture">
                        <div class="user-details2">
                            <p class="profile-name2">Daniel Gaspar</p>
                            <p class="profile-course2">Bachelor of Science in Social Work (BSSW)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup4" id="popup4">
            <div class="comment">
                <h3>Monica's Post</h3>
                <i class="fa-solid fa-circle-xmark" onclick="closePopup4()"></i>
            </div>
            <div class="panel4">
                <div class="comments-container">
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/mel.jpg" alt="Profile Picture">
                    </div>
                    <div class="user-details4">
                        <p class="profile-name4">Melanie Lopez</p>
                        <p class="profile-course4">Bachelor of Science in Information Systems (BSIS)</p>
                        <p class="profile-comment" id="editableComment" contenteditable="false">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div> 
                <div class="info4">
                    <p class="time">1h</p>
                    <p id="taym" class="time" onclick="toggleEdit()">Edit</p>
                    <p id="taym" class="time" onclick="deletePopup()">Delete</p>
                </div>
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/jeyd.jpg" alt="Profile Picture">
                    </div>
                    <div class="user-details4">
                        <p class="profile-name4">Jade Riel Abuela</p>
                        <p class="profile-course4">Bachelor of Arts in Broadcasting (BAB)</p>
                        <p class="profile-comment" id="editableComment2" contenteditable="false">Error nihil delectus minima velit. Dolore ad, qui pariatur velit saepe architecto doloremque amet?</p>
                    </div>
                    </div>
                    <div class="info4">
                        <p class="time">2h</p>
                        <p id="taym2" class="time" onclick="toggleEdit2()">Edit</p>
                        <p id="taym" class="time" onclick="deletePopup()">Delete</p>
                    </div>
                <div class="left-section2">
                    <div class="profile-info2">
                        <img src="./img/gaspar.jpg" alt="Profile Picture">
                    </div>
                    <div class="user-details4">
                        <p class="profile-name4">Daniel Gaspar</p>
                        <p class="profile-course4">Bachelor of Science in Social Work (BSSW)</p>
                        <p class="profile-comment" id="editableComment3" contenteditable="false" tabindex="0">Distinctio, deleniti neque doloribus autem cum voluptas odit?</p>
                    </div>
                </div> 
                <div class="info4">
                    <p class="time">3h</p>
                    <p id="taym3" class="time" onclick="toggleEdit3()">Edit</p>
                    <p id="taym" class="time" onclick="deletePopup()">Delete</p>
                </div>
                </div>
                <div class="left-section5">
                    <div class="profile-info">
                        <img src="./img/mel.jpg" alt="Profile Picture">
                    </div>
                    <div class="user-detailsss">
                        <input type="text" class="profile-comment" placeholder="Comment as Melanie Lopez" />
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>

</body>
<script src="{{ asset('js/dashboard.js') }}"></script>
</html>