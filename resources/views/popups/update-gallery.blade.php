<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery Post</title>
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

        <h3 class="i-name">Edit Gallery Post</h3>

        <div style="display: flex; flex-direction: row; gap: 35px">

    <div class="main-body mt-7 ml-4 mr-2">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        </div>

    </div>

        <div class="con">
            <div class="event">
                <a href="{{ route('gallery') }}" class="post-button">Gallery</a>
                <a href="{{ route('gallery.add') }}" class="up-event">Post Image</a>
            </div>
        </div>

        <div class="container">
            <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="panel">
                    <div class="bio-graph-heading">
                        EDIT POST
                    </div>
                    <div class="panel-body bio-graph-info">
                        
                        <div class="row">
                        </div>

                        <!-- <div class="input-container">
                            <div class="title-input">
                                <input type="text" name="img_title" value="{{ $gallery->img_title }}" placeholder="Image Title">
                                <div class="course-input">
                                    <select name="course" value="{{ $gallery->course }}" id="course" required>
                                            <option value="" selected disabled>Course</option>
                                            <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BAB)</option>
                                            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                            <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology (BSAT)</option>
                                            <option value="Bachelor of Science in Accounting Information Systems">Bachelor of Science in Accounting Information Systems (BSAIS)</option>
                                            <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work (BSSW)</option>
                                            <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems (BSIS)</option>
                                            <option value="Computer Technology">Computer Technology (CT)</option>
                                            <option value="Computer Programming">Computer Programming (CP)</option>
                                            <option value="Health Care Services">Health Care Services (HCS)</option>
                                            <option value="International Cookery">International Cookery (IC)</option>
                                            <option value="Mass Communication">Mass Communication (MC)</option>
                                            <option value="Nursing Student">Nursing Student (NS)</option>
                                            <option value="Office Management">Office Management (OM)</option>
                                    </select>
                                </div>
                            </div>
                            <label for="file-upload" class="file-upload-label">
                                <span>Add Image</span>
                                <i class="fas fa-image">{{ $gallery->media_url }}</i>
                            </label>
                            <input id="file-upload" type="file" name="media_url" value="{{ $gallery->media_url }}" accept="image/*" class="file-upload">
                        </div>  
                        <textarea placeholder="Image description" name="img_description" class="event-details">{{ $gallery->img_description }}</textarea>
                        <button type="submit" class="post-button-ann">SAVE</button>
                    </div> -->

                    <div class="input-container">
                            <div class="title-input">
                                <input type="text" name="img_title" placeholder="Image Title" value="{{ $gallery->img_title }}">
                            </div>
                            <div class="course-input">
                                <select class="select"  name="course" value="{{ $gallery->course }}" id="course" required>
                                    <option value="{{ $gallery->course }}">{{ $gallery->course }}</option>
                                    <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BAB)</option>
                                    <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                                    <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology (BSAT)</option>
                                    <option value="Bachelor of Science in Accounting Information Systems">Bachelor of Science in Accounting Information Systems (BSAIS)</option>
                                    <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work (BSSW)</option>
                                    <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems (BSIS)</option>
                                    <option value="Associate in Computer Technology">Associate in Computer Technology (ACT)</option>
                                    <option value="Computer Technology">Computer Technology (CT)</option>
                                    <option value="Computer Programming">Computer Programming (CP)</option>
                                    <option value="Health Care Services">Health Care Services (HCS)</option>
                                    <option value="International Cookery">International Cookery (IC)</option>
                                    <option value="Mass Communication">Mass Communication (MC)</option>
                                    <option value="Nursing Student">Nursing Student (NS)</option>
                                    <option value="Office Management">Office Management (OM)</option>
                                </select>
                            </div>
                            <label for="file-upload" class="file-upload-label">
                                <span id="add-image-text">Add Image</span>
                                <i id="image-icon" >{{ $gallery->media_url }}</i>
                            </label>
                            <input id="file-upload" type="file" name="media_url" value="{{ $gallery->media_url }}" accept="image/*" class="file-upload">
                        </div>
                        <textarea placeholder="Image description" name="img_description" class="event-details">{{ $gallery->img_description }}</textarea>
                        <div class="button-container">
                            <button type="submit" class="save-button-ann">SAVE</button>
                            
                        

                            
                
            </form>
            <!-- <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sm btn-danger mb-1">Delete</button>
                    </form> -->
                    <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button-ann">DELETE</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        
                </div>
        </div>
    </section>
</body>

<script src="{{ asset('js/header.js') }}"></script>
<script>
    
$(document).ready(function() {
    var mediaUrl = "{{ $gallery->media_url }}"; 
    var maxLength = 20; 

    if (mediaUrl) {
        $('#add-image-text').hide(); 
        $('#image-icon').text(truncateFileName(mediaUrl, maxLength));
    }

    function truncateFileName(fileName, maxLength) {
        if (fileName.length > maxLength) {
            return fileName.substring(0, maxLength - 3) + '...';
        }
        return fileName;
    }
});

</script>
</html>