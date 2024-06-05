<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/events.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/post-event.css') }}">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <!-- <script src="jquery-3.5.1.min.js"></script> -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body style="margin-top: 70px">
    
    @include('main')

    <section id="interface" class="ml-0 lg:ml-72 w-full">

        <h3 class="i-name">
            <a href="{{ route('events') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>Edit Announcement
        </h3>

    <div style="display: flex; flex-direction: row; gap: 35px">

        <div class="main-body mt-7 ml-4 mr-2" style="margin-left: 15px;">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="show-success">
                {{ session('success') }}
            </div>
        @endif

        </div>

    </div>

    <div class="bg-white p-4 m-4 lg:m-10">
        <div class="panel">
            <div class="bio-graph-heading">
                EDIT POST
            </div>
            <div class="panel-body bio-graph-info">
                <div class="row">
                <p class="bold">
                        Fill in the subject and body of announcement details and press ‘POST’ to notify all alumni
                    </p>
                </div>
                

                
                    <form action="{{ route('update.ann', $ann->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div style="display: flex; flex-direction: column;">
                            <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                                <div class="border-2 w-full p-2">
                                    <input type="text" name="ann_title" value="{{ $ann->ann_title }}" placeholder="Title">
                                </div>
                            </div>
                            <div class="flex mx-4 lg:mx-10">
                                <textarea placeholder="Event details" name="ann_details" class="border-2 w-full h-32 outline-none">{{ $ann->ann_details }}</textarea>
                            </div>
                            <div class="button-container">
                                <button type="submit" class="save-button-ann text-white">SAVE</button>
                                
                            
                    </form>
                    <!-- Separate form for deleting announcement -->
                                <form id="delete-form" action="{{ route('delete.ann', $ann->id) }}" method="POST" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button-ann text-white">DELETE</button>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>

</section>

</body>
<!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
<!-- <script src="{{ asset('js/events.js') }}"></script> -->
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post? This action cannot be undone.');
    }
</script>
</html>

<style>
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
    .container {
        height: 450px
    }
    .date-and-time {
        margin-left: 40px;
        margin-bottom: 10px;
        display: flex;
    }

    .show-success{
    background-color: #D4EDDA;
    color: green;
    padding: 15px 420px;
    margin: 15px 30px 0;
    text-align:center;
}
</style>
