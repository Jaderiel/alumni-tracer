@foreach($forumPosts as $post)
    <div class="forum-section">
        <div class="left-section flex items-center justify-between">
            <div class="profile-info flex items-center">
                <img src="./img/Picture1.png" alt="Profile Picture" class="w-12 h-12 rounded-full">
                <div class="user-details">
                    <p class="profile-name">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                    <p class="profile-course">{{ $post->user->course }}</p>
                </div>
            </div>
            <i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup2()"></i>
        </div>
        
        <div class="center-section2 flex items-center">
            <p class="mr-2">{{ $post->caption }}</p>
            <img src="{{ $post->media_url }}" alt="Image" class="image-posted"> 
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