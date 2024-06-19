<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/add-gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">Edit Gallery</h3>

        <div style="display: flex; flex-direction: row; gap: 35px">

            <div class="main-body mt-7 ml-4 mr-2">
                @if(session('error'))
                <div id="errorMessage" class="error-popup">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div id="successMessage" class="success-popup">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div id="errorMessage" class="error-popup">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
            </div>

        </div>

        <div class="con mx-5 lg:mx-20">
            <div class="event flex flex-col lg:flex-row justify-center items-center p-6 gap-2 mx-0 lg:mx-32 lg:gap-6">
                <a href="{{ route('gallery') }}" class="post-button w-full">Gallery</a>
                <a href="{{ route('gallery.add') }}" class="up-event w-full">Post Image</a>
            </div>
        </div>

        <div class="mx-5 lg:mx-20 bg-white">
            <div class="panel m-4">
                <div class="bio-graph-heading">EDIT POST</div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                        To edit, make the necessary changes to the title, course, image, and description, then press 'SAVE' to update. If you want to delete the post, select 'DELETE'.
                        </p>
                    </div>

                    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                            <div class="w-full">
                                <div class="border-2 w-full p-2">
                                    <input type="text" name="img_title" placeholder="Image Title" value="{{ $gallery->img_title }}" class="w-full outline-none">
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="border-2 w-full p-2">
                                    <select class="w-full outline-none" name="course" id="course" required>
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
                            </div>
                            <label for="file-upload" class="border-2 w-full p-2">
                                <span id="add-image-text">Add Image</span>
                                <i id="image-icon">{{ $gallery->media_url }}</i>
                            </label>
                            <input id="file-upload" type="file" name="media_url" value="{{ $gallery->media_url }}" accept="image/*" class="file-upload">
                        </div>
                        <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                            <div class="w-full">
                                <textarea placeholder="Image description" name="img_description" class="border-2 w-full p-2">{{ $gallery->img_description }}</textarea>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="submit" class="save-button-ann text-white">SAVE</button>
                    </form>
                    <form id="delete-form" action="{{ route('gallery.delete', $gallery->id) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button-ann text-white">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

            if ("{{ session('success') }}") {
                $('#successMessage').fadeIn().delay(5000).fadeOut();
            }

            if ("{{ session('error') }}") {
                $('#errorMessage').fadeIn().delay(5000).fadeOut();
            }

            if ($('.error-popup').length) {
                $('.error-popup').fadeIn().delay(5000).fadeOut();
            }
        });

        function confirmDelete() {
            return confirm('Are you sure you want to delete this post? This action cannot be undone.');
        }
    </script>
</body>

<style>
    .success-popup, .error-popup {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .success-popup {
        background-color: #4CAF50;
    }

    .error-popup {
        background-color: #F44336;
    }
</style>

</html>
