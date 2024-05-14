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
                    @foreach($superAdmin as $superadmin)
                    <tr>
                        <td>
                            <div>
                                <h5>{{ $superadmin->first_name }} {{ $superadmin->last_name }}</h5>
                            </div>
                        </td>
                        <td class="action" style="display: flex">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <a href="#" class="button openModal" data-user-id="{{ $superadmin->id }}" data-user-name="{{ $superadmin->first_name }} {{ $superadmin->last_name }}" data-user-role="{{ $superadmin->user_type }}">Edit Role</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
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
                    @foreach($admin as $adminUser)
                    <tr>
                        <td>
                            <div>
                                <h5>{{ $adminUser->first_name }} {{ $adminUser->last_name }}</h5>
                            </div>
                        </td>
                        <td class="action" style="display: flex">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <a href="#" class="button openModal" data-user-id="{{ $adminUser->id }}" data-user-name="{{ $adminUser->first_name }} {{ $adminUser->last_name }}" data-user-role="{{ $adminUser->user_type }}">Edit Role</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h3>Program Head</h3>

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
                    @foreach($programHead as $programhead)
                    <tr>
                        <td>
                            <div>
                                <h5>{{ $programhead->first_name }} {{ $programhead->last_name }}</h5>
                            </div>
                        </td>
                        <td class="action" style="display: flex">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <a href="#" class="button openModal" data-user-id="{{ $programhead->id }}" data-user-name="{{ $programhead->first_name }} {{ $programhead->last_name }}" data-user-role="{{ $programhead->user_type }}">Edit Role</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h3>Alumni Officer</h3>

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
                    @foreach($alumniOfficer as $alumniofficer)
                    <tr>
                        <td>
                            <div>
                                <h5>{{ $alumniofficer->first_name }} {{ $alumniofficer->last_name }}</h5>
                            </div>
                        </td>
                        <td class="action" style="display: flex">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <a href="#" class="button openModal" data-user-id="{{ $alumniofficer->id }}" data-user-name="{{ $alumniofficer->first_name }} {{ $alumniofficer->last_name }}" data-user-role="{{ $alumniofficer->user_type }}">Edit Role</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editRoleForm" action="{{ route('updateRole') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="modalUserId">
                <p id="modalUserName"></p>
                <select name="user_role" id="modalUserRole" required>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Admin">Admin</option>
                    <option value="Program Head">Program Head</option>
                    <option value="Alumni Officer">Alumni Officer</option>
                </select>
                <button type="submit">Update Role</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('myModal');
            var span = document.getElementsByClassName("close")[0];

            document.querySelectorAll('.openModal').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var userId = this.dataset.userId;
                    var userName = this.dataset.userName;
                    var userRole = this.dataset.userRole;

                    document.getElementById('modalUserId').value = userId;
                    document.getElementById('modalUserName').innerText = userName;
                    document.getElementById('modalUserRole').value = userRole;

                    modal.style.display = "block";
                });
            });

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
</body>
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
        margin: 20% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 30%; /* Could be more or less, depending on screen size */
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
