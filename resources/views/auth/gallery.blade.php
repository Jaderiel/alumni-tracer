<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        /* Disable right-click */
        body {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE10+/Edge */
            user-select: none; /* Standard */
        }

        /* Disable text selection */
        ::selection {
            background: none;
        }
    </style>
</head>

<body class="mt-16" oncontextmenu="return false;">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

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

        <h3 class="i-name">Gallery</h3>

        <div class="mx-10">
            <div class="event flex flex-col lg:flex-row justify-center items-center p-6 gap-2 mx-0 lg:mx-32 lg:gap-6">
                <select name="course" id="courseFilter" class="post-button w-full">
                    <option value="" selected disabled>Course</option>
                    <option value="all">All</option>
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
                <a href="{{ route('gallery.add') }}">
                    <button class="up-event w-full">Upload Image <i class="fas fa-circle-plus"></i></button>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4" id="filterable-cards">
                @foreach($gallery as $gal)
                <div class="filterable_cards" data-course="{{ $gal->course }}">
                    <div class="card h-full">
                        <img src="{{ $gal->media_url }}" class="card-img-top img-fluid" alt="Image" data-toggle="modal" data-target="#imageModal" data-image="{{ $gal->media_url }}">
                        <div class="card_body p-0">
                            <div class="flex justify-between mx-4 my-4">
                                <h6 class="font-bold">{{ $gal->img_title }}</h6>
                                @if(Auth::check() && (Auth::user()->user_type === 'Super Admin' || Auth::user()->id === $gal->user_id))
                                <div class="card-options">
                                    <a href="{{ route('gallery.edit', ['gallery' => $gal->id]) }}"><i class="fas fa-ellipsis-v text-yellow-600 ml-" onclick="openPopup()"></i></a>
                                </div>
                                @endif
                            </div>
                            <div class="flex flex-col justify-between m-4">
                                <p class="text-xs">{{ $gal->img_description }}</p>
                                <p class="card-text-course">{{ $gal->course }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white p-4">
                    <div class="flex justify-between items-start">
                        <h5 class="text-xl font-bold">Image Preview</h5>
                        <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    <div class="mt-4">
                        <img id="modalImage" src="" class="w-full h-auto" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('[data-toggle="modal"]').forEach(function(img) {
                img.addEventListener('click', function() {
                    const imageUrl = img.getAttribute('data-image');
                    document.getElementById('modalImage').setAttribute('src', imageUrl);
                    document.getElementById('imageModal').classList.remove('hidden');
                });
            });
        });

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Disable PrintScreen key
        document.addEventListener('keyup', function (e) {
            if (e.key == 'PrintScreen') {
                navigator.clipboard.writeText('');
                var overlay = document.createElement('div');
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'black';
                overlay.style.zIndex = '9999';
                document.body.appendChild(overlay);
                setTimeout(function() {
                    alert('Screenshots are disabled on this webpage.');
                    document.body.removeChild(overlay);
                }, 100); // Delay the alert to ensure overlay is displayed first
            }
        });

        // Periodically clear clipboard data
        setInterval(function () {
            navigator.clipboard.writeText('');
        }, 300);
    </script>

    <!-- JavaScript for Filtering -->
    <script>
        $(document).ready(function() {
            $('#courseFilter').change(function() {
                var selectedCourse = $(this).val();
                if (selectedCourse === "all") {
                    $('.filterable_cards').show();
                } else {
                    $('.filterable_cards').hide();
                    $('.filterable_cards[data-course="' + selectedCourse + '"]').show();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
        if ("{{ session('success') }}") {
            $('#successMessage').fadeIn().delay(5000).fadeOut();
        }

        if ("{{ $errors->any() }}") {
            $('#errorMessage').fadeIn().delay(5000).fadeOut();
        }
    });
    </script>
</body>

</html>

<style>
    .search-course {
        display: flex;
        width: 40%;
        height: 40px;
        align-items: center;
        padding: 10px;
        border: 1px solid #2D55B4;
        border-radius: 4px;
    }

    .search-course select {
        border: none;
        outline: none;
        font-size: 13px;
        background-color: #EFF2FB;
        width: 100%;
        cursor: pointer;
    }

    .modal {
        transition: opacity 0.25s ease;
    }

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

        .show-success {
            background-color: #D4EDDA;
            color: green;
            padding: 15px;
            margin: 15px 40px;
            text-align: center;
        }
</style>
