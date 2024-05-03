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
    <!-- <script src="jquery-3.5.1.min.js"></script> -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="gallery.js" defer></script> -->
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

        <h3 class="i-name">
            Gallery
        </h3>

        <div class="container">
            <div class="filter_buttons">
                <button class="active" data-name="all">All</button>
                <button data-name="act" title="Associate in Computer Technology">ACT</button>
                <button data-name="bab" title="Bachelor of Arts in Broadcasting">BAB</button>
                <button data-name="bsa" title="Bachelor of Science in Accountancy">BSA</button>
                <button data-name="bsais" title="Bachelor of Science in Accountancy Information Systems | BSA Technology">BSAIS</button>
                <button data-name="bssw" title="Bachelor of Science in Social Work">BSSW</button>
                <button data-name="bsis" title="Bachelor of Science in Information Systems">BSIS</button>
                <button data-name="ct" title="Computer Technology">CT</button>
                <button data-name="cp" title="Computer Programming">CP</button>
                <button data-name="hcs" title="Health Care Services">HCS</button>
                <button data-name="ic" title="International Cookery">IC</button>
                <button data-name="mc" title="Mass Communication">MC</button>
                <button data-name="ns" title="Nursing Student">NS</button>
                <button data-name="om" title="Office Management">OM</button>

                <a href="{{ route('gallery.add') }}">
                    <button class="btn" data-filter="">ADD <i class="fas fa-circle-plus "></i></button>
                </a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 15px; margin-top: 10px;" id="filterable-cards">

            @foreach($gallery as $gal)
                <div style="background-color: white; margin-left:" data-course="{{$gal->course}}">
                    <div style="background-color: white;">
                        <img src="{{$gal->media_url}}" class="card-img-top img-fluid" alt="Image" data-name="act" data-toggle="modal" data-target="#imageModal" data-image="{{$gal->media_url}}">
                        <div class="card-body">
                            <h6 class="card-title">{{$gal->img_title}}</h6>
                            @if(Auth::check() && Auth::user()->user_type === 'Admin' || Auth::user()->id === $gal->user_id)
                            <a href="{{ route('gallery.edit', ['gallery' => $gal->id]) }}"><i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup()"></i></a>
                            @endif
                        </div>
                        <p class="card-text">{{$gal->img_description}}</p>
                        <p style="font-size: 10px; margin-top: 10px; margin-left: 20px">{{$gal->course}}</p>
                    </div>
                </div>
            @endforeach


            </div>

    </section> 

    <!-- Image Modal -->
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

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for Modal -->
    <script>
        // JavaScript for Modal
        
    </script>
<!-- Place this script at the end of the body section -->
<!-- Place this script at the end of the body section -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add an event listener to each image in the grid
        document.querySelectorAll('[data-toggle="modal"]').forEach(function(img) {
            img.addEventListener('click', function() {
                // Retrieve the data-image attribute (which contains the image URL) of the clicked image
                const imageUrl = img.getAttribute('data-image');
                // Set the src attribute of the modal image
                document.getElementById('modalImage').setAttribute('src', imageUrl);
                // Display the image URL in the modal
                document.getElementById('imageId').innerText = imageUrl;
                // Show the modal
                $('#imageModal').modal('show');
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
    // Function to filter items
    function filterItems(course) {
        // Hide all items
        $('#filterable-cards div').hide();
        // Show items with matching course
        var $filteredItems = $('#filterable-cards div[data-course="' + course + '"]');
        $filteredItems.show();
        console.log('Filtered items count:', $filteredItems.length);
        $filteredItems.each(function() {
            console.log('Filtered item data-course:', $(this).data('course'));
        });
    }

    // Event listener for BAB button
    $('#babButton').click(function() {
        // Call filterItems function with course 'Bachelor of Arts in Broadcasting'
        filterItems('Bachelor of Arts in Broadcasting');
    });
});

</script>



</body>

</html>