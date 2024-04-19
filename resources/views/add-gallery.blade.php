<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <section id="menu">
        @if(Auth::user()->user_type === 'Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">Gallery</h3>

        <div class="con">
            <div class="event">
                <a href="{{ route('gallery') }}" class="post-button">Gallery</a>
                <a href="{{ route('gallery.add') }}" class="up-event">Post Image</a>
            </div>
        </div>

        <div class="container">
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="panel">
                    <div class="bio-graph-heading">
                        CREATE POST
                    </div>
                    <div class="panel-body bio-graph-info">
                        @if(Session::has('success'))
                            <div class="alert alert-success" style="display: flex; justify-content: center;">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <p class="bold">Fill in the subjects and press ‘POST’ to notify all alumni</p>
                        </div>

                        <div class="input-container">
                            <div class="title-input">
                                <input type="text" name="img_title" placeholder="Image Title">
                                <input type="text" name="course" placeholder="course">
                            </div>
                            <label for="file-upload" class="file-upload-label">
                                <span>Add Image</span>
                                <i class="fas fa-image"></i>
                            </label>
                            <input id="file-upload" type="file" name="image" accept="image/*" class="file-upload">
                        </div>  
                        <textarea placeholder="Image description" name="img_description" class="event-details"></textarea>
                        <button type="submit" class="post-button-ann">POST</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>