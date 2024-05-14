<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="card-holder">
        @foreach($gallery as $gal)
        <div class="content-holder-gallery">
            <div class="left-content">
                <div class="image-holder">
                    <img src="{{$gal->media_url}}" alt="">
                </div>
                <div class="detail-holder">
                    <h3><strong>{{$gal->img_title}}</strong></h3>
                    <p>{{$gal->course}}</p>
                    <p>{{$gal->img_description}}</p>
                    <h5>Posted by: {{$gal->user->first_name}} {{$gal->user->last_name}}</h5>
                </div>
            </div>
            <div>
                <div class="button-holder">
                    <form action="{{ route('gallery.approve', $gal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="approve-button" onclick="return confirm('Are you sure you want to approve this gallery post?')">Approve</button>
                    </form>
                    <form action="{{ route('gallery.delete', $gal->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this gallery post?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>

<style>
    .content-holder-gallery {
        display: flex;
        justify-content: space-between;
        background-color: white;
        border-radius: 20px;
        height: 200px;
        width: 800px;
        padding: 20px;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .content-holder-gallery:hover {
        transform: scale(1.02);
    }
    .left-content {
        display: flex;
        gap: 10px
    }
    .image-holder {
        width: 250px;
    }

    .image-holder img {
        border-radius: 20px;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    .detail-holder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 4px;
        flex: 1;
        overflow-y: auto;
    }
    .card-holder {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .approve-button {
        padding: 2px 10px 2px 10px;
        background-color: #00A36C;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 3px
    }

    .approve-button:hover {
        background-color: #2D55B4;
    }

    .delete-button {
        padding: 2px 10px 2px 10px;
        background-color: maroon;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 3px
    }

    .delete-button:hover {
        background-color: #900C3F;
    }

    .button-holder {
        display: flex;
        flex-direction: row;
        gap: 4px
    }
</style>