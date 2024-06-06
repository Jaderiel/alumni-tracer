<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #162F65;
            margin: 0;
        }
        .forgot-password-container {
            background: #fff;
            padding: 20px 40px; 
            max-width: 300px;
            width: 100%;
            text-align: center;
            border-radius: 1rem;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .forgot-password-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .forgot-password-container .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .forgot-password-container .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }
        .forgot-password-container .input-group input {
            width: 93%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .forgot-password-container .input-group input:focus {
            border-color: #007BFF;
        }
        .forgot-password-container .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .forgot-password-container .btn {
            display: inline-block;
            width: 48%;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #E8AF30;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .forgot-password-container .btn:hover {
            background-color: #E09B00;
        }
        .forgot-password-container .cancel-btn {
            background-color: #ccc;
            color: black;
        }
        .forgot-password-container .cancel-btn:hover {
            background-color: #999;
        }
        .forgot-password-container .status-message, .forgot-password-container .error-message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }
        .forgot-password-container .status-message {
            background-color: #d4edda;
            color: #155724;
        }
        .forgot-password-container .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @if (session('status'))
                <div class="status-message">{{ session('status') }}</div>
            @endif
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>
            <div class="btn-container">
                <button type="button" class="btn cancel-btn">Cancel</button>
                <button type="submit" class="btn">Send</button>
            </div>
        </form>
    </div>
</body>
</html>
