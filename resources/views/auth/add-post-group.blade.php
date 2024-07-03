<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Post</title>
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full">
        <h3 class="i-name">
            <a href="{{ route('dashboard') }}" class="back-link" ><i class="fa-solid fa-angles-left"></i> Back</a>Make a Post
        </h3>

        <div id="successMessage" class="success-popup">
            Post created successfully!
        </div>

        <div id="errorMessage" class="error-popup">
            {{ session('error') }}
        </div>

        <div class="bg-white p-4 lg:m-5" style="margin: 20px 40px">
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

                    <form action="{{ route('group-forum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                            <div class="border-2 w-full p-2">
                                <input type="text" name="caption" placeholder="Caption" class="w-full outline-none">
                            </div>
                            <div class="border-2 w-full lg:w-1/2 p-2">
                                <label for="file-upload" class="cursor-pointer" id="file-upload-label">
                                    <span>Add Image</span>
                                    <i class="fas fa-image"></i>
                                </label>
                                <input id="file-upload" type="file" name="image" accept="image/*" class="file-upload w-full">
                            </div>
                        </div>
                        <button type="submit" class="post-button-ann text-white">POST</button>
                    </form>
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

    document.addEventListener('DOMContentLoaded', function() {
        if ("{{ session('success') }}") {
            $('#successMessage').fadeIn().delay(3000).fadeOut();
        }
        if ("{{ session('error') }}") {
            $('#errorMessage').fadeIn().delay(3000).fadeOut();
        }
    });
</script>

<style>

.success-popup, .error-popup {
    display: none;
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    width: 300px;
    text-align: center;
}

.success-popup {
    background-color: #4CAF50;
    color: white;
}

.error-popup {
    background-color: #F44336;
    color: white;
}

.i-name{
    color:#2D55B4;
    padding: 20px 30px 0 30px;
    font-size: 24px;
    font-weight: 700;
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

.show-success{
    background-color: #D4EDDA;
    color: green;
    padding: 15px;
    margin: 15px 40px;
    text-align:center;
}
</style>
