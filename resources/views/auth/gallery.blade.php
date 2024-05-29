<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">Gallery</h3>

        <div class="mx-10">
            <div class="flex justify-between items-center">
                <div class="search-course">
                    <select name="course" id="courseFilter">
                        <option value="all" selected>All</option>
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
                <div>
                    <a href="{{ route('gallery.add') }}">
                        <button class="btn hover:bg-yellow-500 hover:text-white rounded-md px-4 py-1" data-filter="">ADD <i class="fas fa-circle-plus"></i></button>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4" id="filterable-cards">
                @foreach($gallery as $gal)
                <div class="filterable_cards " data-course="{{ $gal->course }}">
                    <div class="card h-full" data-name="Bachelor of Arts in Broadcasting">
                        <img src="{{ $gal->media_url }}" class="card-img-top img-fluid" alt="Image" data-toggle="modal" data-target="#imageModal" data-image="{{ $gal->media_url }}">
                        <div class="card_body p-0">
                            <div class="flex justify-between mx-4 my-4">
                                <h6 class="font-bold">{{ $gal->img_title }}</h6>
                                @if(Auth::check() && Auth::user()->user_type === 'Super Admin' || Auth::user()->id === $gal->user_id)
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

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('[data-toggle="modal"]').forEach(function(img) {
                img.addEventListener('click', function() {
                    const imageUrl = img.getAttribute('data-image');
                    document.getElementById('modalImage').setAttribute('src', imageUrl);
                    $('#imageModal').modal('show');
                });
            });
        });
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
</body>

</html>

<style>
    .search-course {
        display: flex;
        width: 40%;
        height: 40px;
        align-items: center;
        padding: 10px 10px 10px;
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
</style>
