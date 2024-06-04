<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Post Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/add-gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">Gallery</h3>

        <div style="display: flex; flex-direction: row; gap: 35px">
            <div class="main-body mt-7 ml-4 mr-2">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success p-4" style="margin-left: 25px;">
                    {{ session('success') }}
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
            <div class="panel">
                <div class="bio-graph-heading">
                    CREATE POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                        Fill in the fields including the image title, course, image, and image description, then press 'POST' to <br> notify all alumni.
                        </p>
                    </div>

                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                        <div class="border-2 w-full p-2">
                            <input type="text" name="img_title" placeholder="Image Title" class="w-full outline-none">
                        </div>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none"  name="course" id="course" required>
                                <option value="" selected disabled>Course</option>
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
                        <div class="border-2 w-full p-2">
                                <label for="file-upload" class="cursor-pointer" id="file-upload-label">
                                    <span>Add Image</span>
                                    <i class="fas fa-image"></i>
                                </label>
                                <input id="file-upload" type="file" name="image" accept="image/*" class="file-upload w-full">
                            </div>
                    </div>
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                        <textarea placeholder="Image description" name="img_description" class="border-2 w-full p-2"></textarea>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="post-button-ann text-white px-20 py-2 m-4">POST</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>

<script>
    document.getElementById('file-upload').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.getElementById('file-upload-label');
        label.innerHTML = '<span>' + fileName + '</span> <i class="fas fa-image"></i>';
    });
</script>