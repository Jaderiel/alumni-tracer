        <form id="update-post-form" method="POST">
            @csrf
            @method('PUT')
            <div class="popup2" id="popup2">
                <div class="edit">
                    <h3>Edit Post</h3>
                    <i class="fa-solid fa-circle-xmark" onclick="closePopup2()"></i>
                </div> 
                <hr>
                    <div class="left-section2">
                        <div class="profile-info2">
                            <img id="profile-pic" src="" alt="Profile Picture">
                            <div class="user-details2">
                                <p id="profile-name2" class="profile-name2"></p>
                                <p id="course" class="profile-course"></p>
                            </div>
                        </div>
                    </div> 
                    <div class="center-section2">
                        <textarea rows="3" id="caption" placeholder="" name="caption"></textarea>
                    </div>
                    <div class="add">
                        <h4>Add to your post</h4>
                        <img id="media-url" src="" alt="add-image">
                    </div>
                    <button type="submit">SAVE</button>
                    <button type="button" style="background-color: rgb(170, 45, 45); margin-top: 0;" onclick="closePopup2()">DELETE</button>
            </div>
        </form>