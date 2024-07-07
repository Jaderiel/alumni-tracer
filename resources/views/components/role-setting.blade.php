<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
</head>
<body id="container">
    <h3 style="margin: 10px 0 1px 480px">Super Admin</h3>

    <div class="table-holder" style="margin-left: 280px">
        <div class="board-list" style="width: 500px">
            <table width="100%" id="userTable">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td style="text-align: center;">Action</td>
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
                        <td class="action" style="display: flex; justify-content: center;">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <div class="flex gap-1">
                                <a href="#" class="button openModal" data-user-id="{{ $superadmin->id }}" data-user-name="{{ $superadmin->first_name }} {{ $superadmin->last_name }}" data-user-role="{{ $superadmin->user_type }}">Edit Role</a>
                                <form action="{{ route('deleteAdmin', $superadmin->id) }}" method="POST" class="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Deactivate</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h3 style="margin: 30px 0 1px 500px;">Admin</h3>

    <div class="table-holder" style="margin-left: 280px">
        <div class="board-list" style="width: 500px">
            <table width="100%" id="userTable">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td style="text-align: center;">Action</td>
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
                        <td class="action" style="display: flex; justify-content: center;">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <div class="flex gap-1">
                                <a href="#" class="button openModal" data-user-id="{{ $adminUser->id }}" data-user-name="{{ $adminUser->first_name }} {{ $adminUser->last_name }}" data-user-role="{{ $adminUser->user_type }}">Edit Role</a>
                                <form action="{{ route('deleteAdmin', $adminUser->id) }}" method="POST" class="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Deactivate</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h3 style="margin: 30px 0 1px 470px;">Program Head</h3>

    <div class="table-holder" style="margin-left: 280px">
        <div class="board-list" style="width: 500px">
            <table width="100%" id="userTable">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td style="text-align: center;">Action</td>
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
                        <td class="action" style="display: flex; justify-content: center;">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <div class="flex gap-1">
                                <a href="#" class="button openModal" data-user-id="{{ $programhead->id }}" data-user-name="{{ $programhead->first_name }} {{ $programhead->last_name }}" data-user-role="{{ $programhead->user_type }}">Edit Role</a>
                                <form action="{{ route('deleteAdmin', $programhead->id) }}" method="POST" class="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Deactivate</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h3 style="margin: 30px 0 1px 475px;">Alumni Officer</h3>

    <div class="table-holder" style="margin-left: 280px">
        <div class="board-list" style="width: 500px">
            <table width="100%" id="userTable">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td style="text-align: center;">Action</td>
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
                        <td class="action" style="display: flex; justify-content: center;">
                            @if(auth()->check() && auth()->user()->user_type === 'Super Admin')
                            <div class="flex gap-1">
                                <a href="#" class="button openModal" data-user-id="{{ $alumniofficer->id }}" data-user-name="{{ $alumniofficer->first_name }} {{ $alumniofficer->last_name }}" data-user-role="{{ $alumniofficer->user_type }}">Edit Role</a>
                                <form action="{{ route('deleteAdmin', $alumniofficer->id) }}" method="POST" class="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Deactivate</button>
                                </form>
                            </div>
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
        <h2>Edit User Role</h2>
        <form id="editRoleForm" action="{{ route('updateRole') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="modalUserId">
            <p class="modal-username" id="modalUserName"></p>
            <select name="user_role" id="modalUserRole" required>
                <option value="Super Admin">Super Admin</option>
                <option value="Admin">Admin</option>
                <option value="Program Head">Program Head</option>
                <option value="Alumni Officer">Alumni Officer</option>
            </select>
            <div class="flex justify-center">
                <button type="submit" class="update-button">Change Role</button>
            </div>
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

        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!confirm('Are you sure you want to deactivate this user?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
</body>
</html>

<style>

    .container{
    width: 95%;
    height: 80%;
    border-radius: 10px;
    overflow: auto;
    background: #fff;
    margin: 20px 20px 0 20px;
    }
    .table-holder {
        display: flex;
        justify-content: start;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        margin: 50px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px 30px;
        border: 1px solid #888;
        width: 80%;
        max-width: 250px;
        border-radius: 10px;
        position: relative;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 28px;
        color: #aaa;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: red;
    }

    h2 {
        margin-bottom: 30px;
    }

    .modal-username {
        font-weight: bold;
        font-size: 15px;
    }

    select {
        width: 100%;
        padding: 2px;
        margin-top: 8px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 13px;
    }

    .update-button {
        background-color: #00A36C;
        color: white;
        padding: 4px 8px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 55%;
        font-size: 13px;
        align-items: center;
        text-align: center;

    }

    .update-button:hover {
        background-color: #2D55B4;
    }

    .delete-button {
        background-color: #BB0237;
        color: white;
        padding: 4px 8px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 55%;
        font-size: 13px;
        align-items: center;
        text-align: center;
    }

    .delete-button:hover {
        background-color: #850227;
    }

</style>
