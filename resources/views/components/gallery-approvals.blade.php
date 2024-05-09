<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="card-holder">
        <div class="content-holder">
            <div class="left-content">
                <div class="image-holder">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSszHtHXYkShquFKPb8D2MXutGH97YCeajQHQ&usqp=CAU" alt="">
                </div>
                <div class="detail-holder">
                    <h3><strong>[Title]</strong></h3>
                    <p>[Course]</p>
                    <p>[Details] okay try natin ulit pag mahaba ang details pano kayang gagawin?</p>
                    <h5>Posted by: [name]</h5>
                </div>
            </div>
            <div>
                <div class="button-holder">
                    <button class="approve-button">Approve</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>
        </div>

        <div class="content-holder">
            <div class="left-content">
                <div class="image-holder">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSszHtHXYkShquFKPb8D2MXutGH97YCeajQHQ&usqp=CAU" alt="">
                </div>
                <div class="detail-holder">
                    <h3><strong>[Title]</strong></h3>
                    <p>[Course]</p>
                    <p>[Details] okay try natin ulit pag mahaba ang details pano kayang gagawin?</p>
                    <h5>Posted by: [name]</h5>
                </div>
            </div>
            <div>
                <div class="button-holder">
                    <button class="approve-button">Approve</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<style>
    .content-holder {
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

    .content-holder:hover {
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