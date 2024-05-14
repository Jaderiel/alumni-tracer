<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <section id="menu">
        @if(Auth::user()->user_type === 'Admin' || Auth::user()->user_type === 'Super Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">Gallery</h3>

        <div class="container">
            <div class="gallery-top-container">
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
                        <button class="btn" data-filter="">ADD <i class="fas fa-circle-plus "></i></button>
                    </a>
                </div>
            </div>

            <div class="container-card" id="filterable-cards">
                @foreach($gallery as $gal)
                <div class="filterable_cards" data-course="{{ $gal->course }}">
                    <div class="card" data-name="Bachelor of Arts in Broadcasting">
                        <img src="{{ $gal->media_url }}" class="card-img-top img-fluid" alt="Image" data-toggle="modal" data-target="#imageModal" data-image="{{ $gal->media_url }}">
                        <div class="card_body">
                            <div class="card-header">
                                <h6 class="card-title">{{ $gal->img_title }}</h6>
                                @if(Auth::check() && Auth::user()->user_type === 'Super Admin' || Auth::user()->id === $gal->user_id)
                                <div class="card-options">
                                    <a href="{{ route('gallery.edit', ['gallery' => $gal->id]) }}"><i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup()"></i></a>
                                </div>
                                @endif
                            </div>
                            <div class="card-text-wrapper">
                                <p class="card-text">{{ $gal->img_description }}</p>
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
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="modalImage" alt="Modal Image">
                </div>
            </div>
        </div>
    </div>

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

    .gallery-top-container {
        display: flex;
        gap: 10px
    }
</style>
