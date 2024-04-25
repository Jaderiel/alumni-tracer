<div class="edit-popup" id="edit-popup" style="display: none;">
    <div class="edit-content">
        <h3>Edit Post</h3>
        <i class="fa-solid fa-circle-xmark" id="clearEditButton" onclick="closeEditPopup()"></i>
        <hr>
        <form action="{{ route('update.post') }}" method="POST">
            @csrf
            <!-- Hidden field to store post ID -->
            <input type="hidden" name="post_id" id="post_id">
            <div class="center-section2">
                <textarea name="edited_caption" id="edited_caption" rows="3" placeholder="Edit your post..."></textarea>
            </div>
            <button type="submit">Save Changes</button>
        </form>
        
        <!-- Delete form -->
        <form id="delete-post-form" action="{{ route('delete.post', ['id' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
        </form>
    </div>
</div>


<style>
    .edit-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    z-index: 9999; /* Ensure it appears above other elements */
    /* Add additional styling as needed */
}
</style>