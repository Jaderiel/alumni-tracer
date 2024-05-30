<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a Post</title>
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full">
        <h3 class="i-name">
            <a href="{{ route('dashboard') }}" class="back-link"><i class="fas fa-arrow-left"></i></a>Update your post
        </h3>

        @if(session('success'))
            <div class="text-green-600 p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 m-4 lg:m-10">
            <div class="panel">
                <div class="bio-graph-heading">
                    CREATE POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                            Fill in the caption and add an image, then press ‘POST’ to notify all alumni
                        </p>
                    </div>

                    <form action="{{ route('update.post', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
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
                        <div class="">
                            <button type="submit" class="post-button-ann text-white">SAVE</button>
                            </form>
                            <form action="{{ route('delete.post', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="post-button-ann text-white bg-red-800">DELETE</button>
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
    .back-link {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
    }

    .back-link:hover {
        color: #000; 
    }
</style>
