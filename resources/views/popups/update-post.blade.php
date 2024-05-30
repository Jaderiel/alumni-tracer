<div class="edit-popup" id="edit-popup" style="display: none;">
    <div class="edit-content">
        <h3>Edit Post</h3>
        <i class="fa-solid fa-circle-xmark" id="clearEditButton" onclick="closeEditPopup()"></i>
        <hr>
        <form action="{{ route('update.post', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Hidden field to store post ID -->
            <input type="hidden" name="post_id" id="post_id">
            <div class="center-section2">
                <textarea name="edited_caption" id="edited_caption" rows="3" placeholder="Edit your post..."></textarea>
            </div>
            <div class="center-section2">
                <label for="edited_media">Edit Media:</label>
                <img id="media-preview" src="" alt="">
                <input type="file" name="edited_media" id="edited_media" accept="image/*">
            </div>

            <button type="submit">Save Changes</button>
        </form>
        
        <!-- Delete form -->
        <form id="delete-post-form" action="{{ route('delete.post', ['id' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button style="background-color: maroon" type="submit">Delete Post</button>
        </form>
    </div>
</div>

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
