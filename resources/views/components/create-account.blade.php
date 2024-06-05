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
                        <label for="role">Role</label>
                        <select class="form-controll" id="role" name="user_type"  style="font-size:13px; width:35%">
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
                    <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-controll" id="username" name="username" value="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-controll" id="password" name="password" value="" style="width: 100%;">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-controll" id="password_confirmation" name="password_confirmation" value="">
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

    .create-account-holder {
            background-color: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
        }

        .heading {
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
            color: #fff;
        }

        .form-group {
            margin-left: 0;
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-controll {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .inline-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        input:focus {
            outline: none;
            border: 2px solid #ADBCF2;
        }

</style>