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
    <script src="jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="gallery.js" defer></script>
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
            <div class="row mt-4 ml-1" id="filter-buttons">
              <div class="col-12">
                <button class="btn mb-2 mx-1  active" data-filter="all">All</button>
                <!-- <button class="btn mb-2 mx-1" data-filter="act" data-toggle="tooltip" data-placement="top" title="Bachelor of Arts in Broadcasting">ACT</button> -->
                <button class="btn mb-2 mx-1" data-filter="bab" data-toggle="tooltip" data-placement="top" title="Bachelor of Arts in Broadcasting">BAB</button>
                <button class="btn mb-2 mx-1" data-filter="bsa" data-toggle="tooltip" data-placement="top" title="Bachelor of Science in Accountancy">BSA</button>
                <button class="btn mb-2 mx-1" data-filter="bsais" data-toggle="tooltip" data-placement="top" title="Bachelor of Science in Accountancy Information Systems | BSA Technology">BSAIS</button>
                <button class="btn mb-2 mx-1" data-filter="bssw" data-toggle="tooltip" data-placement="top" title="Bachelor of Science in Social Work">BSSW</button>
                <button class="btn mb-2 mx-1" data-filter="bsis" data-toggle="tooltip" data-placement="top" title="Bachelor of Science in Information Systems">BSIS</button>
                <button class="btn mb-2 mx-1" data-filter="ct" data-toggle="tooltip" data-placement="top" title="Computer Technology">CT</button>
                <button class="btn mb-2 mx-1" data-filter="cp" data-toggle="tooltip" data-placement="top" title="Computer Programming">CP</button>
                <button class="btn mb-2 mx-1" data-filter="hcs" data-toggle="tooltip" data-placement="top" title="Health Care Services">HCS</button>
                <button class="btn mb-2 mx-1" data-filter="ic" data-toggle="tooltip" data-placement="top" title="International Cookery">IC</button>
                <button class="btn mb-2 mx-1" data-filter="mc" data-toggle="tooltip" data-placement="top" title="Mass Communication">MC</button>
                <button class="btn mb-2 mx-1" data-filter="ns" data-toggle="tooltip" data-placement="top" title="Nursing Student">NS</button>
                <button class="btn mb-2 mx-1" data-filter="om" data-toggle="tooltip" data-placement="top" title="Office Management">OM</button>
                
                <a href="{{ route('gallery.add') }}"><button class="btn mb-2 mx-1" data-filter="">ADD <i class="fas fa-circle-plus "></i></button></a>

                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 15px; margin-top: 10px;" id="filterable-cards">

                @foreach($gallery as $gal)
                    <div style="background-color: white;" data-name="act" data-toggle="modal" data-target="#imageModal" data-image="img/bsis-corndog.jpg">
                        <img src="{{$gal->media_url}}" class="card-img-top img-fluid" alt="Image" data-toggle="modal" data-target="#imageModal">
                    <div class="card-body">
                        <h6 class="card-title">{{$gal->img_title}}</h6>
                        <i class="fas fa-ellipsis-v text-gray-600 ml-" onclick="openPopup()"></i>
                    </div>
                        <p class="card-text">{{$gal->img_description}}</p>
                    </div>
                @endforeach

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

    <div class="popup" id="popup">
        <div class="create">
            <i class="fa-solid fa-circle-xmark" onclick="closePopup()"></i>
            <div class="panel">
                <div class="bio-graph-heading">
                    EDIT POST
                </div>
                <div class="panel-body bio-graph-info">
                    <div class="row">
                        <p class="bold">
                            Fill in the subject and body of description and press ‘SAVE’ to update   
                        </p>
                    </div>
    
                    <div class="input-container">
                        <div class="title-input">
                          <input type="text" placeholder="Graduation 2022-2023">
                        </div>
                        <label for="file-upload" class="file-upload-label">
                          <span>Change image</span>
                          <i class="fas fa-image"></i>
                        </label>
                        <input id="file-upload" type="file" accept="image/*" class="file-upload">
                    </div>  
                    <textarea placeholder="Image description" class="event-details"></textarea>
                    <button type="button" onclick="closePopup()">SAVE</button>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for Modal -->
    <script>
        // JavaScript for Modal
        
    </script>

</body>
<script src="{{ asset('js/gallery.js') }}"></script>
</html>