<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name-user">
            <a href="{{ route('profile.edit') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>
            Change Password
        </h3>

            <form action="{{ route('update.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-4 my-20 justify-center items-center">
                    <div>
                        @error('current_password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        @error('new_password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <p>Enter Current Password</p>
                        <input type="password" name="current_password" required>
                    </div>

                    <div>
                        <p>Enter New Password</p>
                        <input type="password" name="new_password" required>
                    </div>

                    <div>
                        <p>Confirm New Password</p>
                        <input type="password" name="new_password_confirmation" required>
                    </div>

                    <div>
                        <button type="submit" class="bg-customBlue text-white text-xs hover:bg-customTextBlue hover:text-black py-2 px-4">Save Changes</button>
                    </div>
                </div>
            </form>
    </section>

</body>
</html>

<style>
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
</style>