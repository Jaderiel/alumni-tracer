<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
            @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: .25rem;">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
    <form method="post" action="{{ route('user.create') }}">
        @csrf 
        <div class="create-account-holder">
            <div class="heading">USER INFORMATION</div>
            
            <div class="panel-btn">
                <div class="inline-group">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-controll" id="first_name" name="first_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-controll" id="middle_name" name="middle_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-controll" id="last_name" name="last_name" value="">
                    </div>
                </div>
                
                <div class="inline-group">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-controll" id="email" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-controll" id="username" name="username" value="">
                    </div>
                    <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-controll" id="role" name="user_type">
                                <option value="" selected disabled>Role</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="Program Head">Program Head</option>
                                <option value="Alumni">Alumni</option>
                                <option value="Alumni Officer">Alumni Officer</option>
                            </select>
                    </div>
                </div>

                <div class="inline-group">
                    <div class="password-holder">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-controll" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm password</label>
                            <input type="password" class="form-controll" name="password_confirmation" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-holder">
                <button type="submit" class="btn-save">CREATE</button>
            </div>
        </div>
    </form>

</body>
</html>

<style>
    .heading {
        margin-bottom: 20px;
    }

    .btn-save {
        padding: 10px 100px 10px 100px;
        background-color: #00A36C;
        color: white;
        cursor: pointer;
        border: none;
        border-radius: 3px
    }

    .btn-save:hover {
        background-color: #2D55B4;
    }

    .button-holder {
        display: flex;
        justify-content: center;
    }

    .password-holder {
        display: flex;
        justify-content: start;
        gap: 20px;
    }

    .create-account-holder {
        background-color: white;
        padding-bottom: 20px;
        border-radius: 20px
    }
</style>