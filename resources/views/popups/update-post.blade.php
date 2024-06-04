<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full">
        <h3 class="i-name">
            <a href="{{ route('dashboard') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>Edit Post
        </h3>

        @if(session('success'))
            <div class="text-green-600 p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 m-10 lg:m-10">
            <div class="panel">
                <div class="bio-graph-heading">
                    EDIT POST
                </div>
                <div class="panel-body bio-graph-info" >
                    <div class="row">
                        <p class="bold">
                        To edit, make the necessary changes to the caption or image, then press 'SAVE' to update. <br>If you want to delete the post, select 'DELETE'.
                        </p>
                    </div>

                    <form action="{{ route('update.post', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2" style="margin-top: 20px">
                            <div class="border-2 w-full p-2">
                                <input type="text" name="caption" value="{{$post->caption}}" placeholder="Caption" class="w-full outline-none">
                            </div>
                            <div class="border-2 w-full lg:w-1/2 p-2">
                                <label for="file-upload" class="cursor-pointer" id="file-upload-label">
                                    <span>{{ basename($post->media_url) ?: 'Add Image' }}</span>
                                    <i class="fas fa-image"></i>
                                </label>
                                <input id="file-upload" type="file" name="image" accept="image/*" class="file-upload w-full">
                            </div>
                        </div>
                        <div class="button-container"><button type="submit" class="save-button-ann text-white">SAVE</button>
                            </form>
                            <form action="{{ route('delete.post', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button-ann text-white">DELETE</button>
                            </form>
                            
                        </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>

<script>
    document.getElementById('file-upload').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.getElementById('file-upload-label');
        label.innerHTML = '<span>' + fileName + '</span> <i class="fas fa-image"></i>';
    });
</script>

<style>
    .i-name {
        color: #2D55B4;
        font-size: 24px;
        font-weight: 700;
        margin-top: 20px;
        margin-left: 10px;
    }

    .back-link {
        margin-top: 20px;
        margin-right: 10px;
        background-color: #FFFFFF;
        color: #2974A7;
        text-decoration: none;
        padding: 5px 13px;
        border-radius: 6px;
        border: 1px solid #2974A7;
        font-size: 13px;
    }

    .back-link:hover {
        background-color: #a6d0ec;
    }
</style>
