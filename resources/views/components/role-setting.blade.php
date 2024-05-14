<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
</head>
<body id="container">
    <h3>Super Admin</h3>

        <div class="table-holder">
            <div class="board-list" style="width: 500px">
                <table width="100%" id="userTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <h5>Fullname</h5>
                                </div>
                            </td>
                            <td class="action" style="display: flex">
                                @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
                                <a href="#" id="openModal" class="button">Edit Role</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <h3>Admin</h3>

        <div class="table-holder">
            <div class="board-list" style="width: 500px">
                <table width="100%" id="userTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <h5>Fullname</h5>
                                </div>
                            </td>
                            <td class="action" style="display: flex">
                                @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
                                <a href="#" id="openModal" class="button">Edit Role</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Jade Riel Abuela</p>
        </div>
    </div>

</body>
<script>
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("openModal");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</html>

<style>
    .table-holder {
        display: flex;
        justify-content: start;
    }
    /* Modal styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
