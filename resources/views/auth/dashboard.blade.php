<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    console.log("Checking authentication status...");
    @if(is_null(Auth::user()) || is_null(Auth::user()->user_type))
        console.log("User is not authenticated or user type is null.");
    @else
        console.log("User is authenticated.");
    @endif
</script>

</head>

<body class="w-full bg-customBgColor relative flex">
    @include('main')

    <section id="interface" class="ml-0 lg:ml-72 w-full">
        
        <h3 class="i-name">
            Dashboard
        </h3>
        <p class="i-nameee pl-4 lg:pl-8">Welcome back, {{ Auth::user()->username }}!</p>
        <div class="values gap-4 p-4 lg:p-8">
            <a href="{{ route('jobs') }}" class="val-box p-0">
                <i class="fa-solid fa-briefcase"></i>
                <div>
                    <h3>{{ $jobCount }}</h3>
                    <span>Job Post</span>
                </div>
            </a>
            <a href="{{ route('events') }}" class="val-box">
                <i class="fa-solid fa-calendar-days"></i>
                <div>
                    <h3>{{ $eventCount }}</h3>
                    <span>Events</span>
                </div>
            </a>
            <a href="{{ route('alumni-list') }}" class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>{{ $verifiedAlumniCount }}</h3>
                    <span>Alumni</span>
                </div>
            </a>
        </div>

        <div class="flex">
            <div class="flex flex-row w-full">
                <div class="flex flex-row px-0 lg:px-10 w-full">
                    <div class="board-1 w-full">
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
                                    <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture">
                                @else
                                    @if (Auth::user()->user_type == 'Super Admin')
                                        <img src="{{ asset('images/SA_avatar.jpg') }}" alt="Super Admin Avatar">
                                    @else
                                    <img src="{{ asset('images/user_avatar.jpg') }}" alt="User Avatar">
                                    @endif
                                @endif
                                    <div class="user-details">
                                        <p class="profile-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                        <p class="profile-course">{{ Auth::user()->user_type !== 'Alumni' ? Auth::user()->user_type : Auth::user()->course }}</p>
                                    </div>
                                </div>
                            </div> 
                            <a href="{{ route('add.post') }}">
                                <button style="background-color: transparent; border: none; cursor: pointer; text-align: left;">
                                    <div class="center-section">
                                        <p>What's on your mind, {{ Auth::user()->username }}?</p>
                                    </div>
                                </button>
                            </a>
                            <div class="right-section">
                                <a href="{{ route('add.post') }}">
                                    <button type="submit" class="post-button">MAKE A POST</button>
                                </a>
                            </div>
                        </div>
                        <hr>
                        
                        @foreach($forumPosts->sortByDesc('created_at') as $post)
                        <div class="forum-section p-0">
                            <div class="p-4">
                                <div style="display: flex; justify-content: space-between; align-items: center">
                                    <div class="profile-info flex items-center">
                                        @if ($post->user->profile_pic)
                                            <img src="{{ $post->user->profile_pic }}" alt="Profile Picture" class="w-8 h-8 rounded-full">
                                        @elseif ($post->user->user_type == 'Super Admin')
                                            <img src="{{ asset('images/SA_avatar.jpg') }}" alt="Super Admin Avatar">
                                        @else
                                            <img src="{{ asset('images/user_avatar.jpg') }}" alt="Placeholder Profile Picture" class="w-8 h-8 rounded-full">
                                        @endif
                                        <div class="user-details">
                                            <p class="profile-name">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                                            <p class="profile-course">{{ $post->user->user_type !== 'Alumni' ? $post->user->user_type : $post->user->course }}</p>
                                        </div>
                                    </div>
                                    @if(auth()->check() && (auth()->user()->id == $post->user->id || auth()->user()->user_type == 'Super Admin'))
                                        <a href="{{ route('showUpdate.post', ['id' => $post->id]) }}">
                                            <div class="elipsis">
                                                <i class="fas fa-ellipsis-v text-gray-600 ml-"></i>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="center-section2 flex flex-col mt-4 gap-2">
                                    <p class="mr-2">{{ $post->caption }}</p>
                                    @if ($post->media_url)
                                        <img src="{{ $post->media_url }}" alt="Image" class="image-posted"> <!-- Use the user's profile picture -->
                                    @else
                                        <p></p> <!-- Use the placeholder image -->
                                    @endif
                                
                                    <div class="likers" onclick="openPopup3('{{ $post->id }}')">
                                        <img src="{{ asset('images/like.png') }}" alt="Image" class="like"> 
                                        <p id="yuzer-{{ $post->id }}">{{ $post->reactions()->where('is_liked', true)->count() }} {{ Str::plural('like', $post->reactions()->where('is_liked', true)->count()) }}</p>
                                    </div>
                                </div>
                            </div>
                            @php
                                $user = Auth::user();
                                $isLiked = $user && $user->reactions()->where('forum_id', $post->id)->where('is_liked', true)->exists();
                            @endphp
                            <div class="forum-section2 bg-white rounded-b-xl thumbs-up-iconn" id="thumbsUpIcon-{{ $post->id }}" data-forum-id="{{ $post->id }}">
                                <table>
                                    <thead>
                                        <tr>
                                            <td>
                                                
                                                <i  
                                                class="fa-solid fa-thumbs-up thumbs-up-icon" 
                                                style="color: {{ $isLiked ? '#228BE6' : 'inherit' }};">
                                                </i>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endforeach


                        <div class="page">
                        {{ $forumPosts->links('components.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-center w-1/2">
                @include('components.announcements')
            </div>
        </div>

    </section>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.thumbs-up-iconn').click(function() {
            var forumId = $(this).data('forum-id');
            var icon = $(this);

            $.ajax({
                url: '{{ route("like") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    forum_id: forumId
                },
                success: function(response) {
                    if (response.success) {
                        if (response.is_liked) {
                            icon.css('color', '#228BE6');
                            location.reload();
                        } else {
                            icon.css('color', 'inherit');
                            location.reload();
                        }
                    }
                },
                error: function(response) {
                    alert('An error occurred while toggling the like status.');
                }
            });
        });
    });
</script>

<script>
    document.getElementById('edited_media').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];

    // Check if a file is selected
    if (file) {
        // Create a FileReader object
        var reader = new FileReader();

        // Set up the FileReader onload event handler
        reader.onload = function(e) {
            // Set the src attribute of the image to the data URL
            document.getElementById('media-preview').src = e.target.result;
        };

        // Read the selected file as a Data URL
        reader.readAsDataURL(file);
    }
});
</script>
</html>

<style>
    .edit-popup {
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 20px;
        z-index: 9999;
    }

    .edit-popup button {
        width: 95%;
        padding: 10px 0;
        margin: 10px;
        background-color: #162F65;
        color: #fff;
        border: 0;
        outline: none;
        font-size: 18px;
        border-radius: 4px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
</style>