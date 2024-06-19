<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="w-full bg-customBgColor relative flex">
    @include('main')

    <section id="interface">
        <div class="header">
            <h3 class="i-name">
                <a href="{{ route('analytics') }}" class="back-link" ><i class="fa-solid fa-angles-left text-sm"></i> Back</a>Preview
            </h3>
            <div class="flex gap-4 justify-end mx-5">
            @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
                <a href="{{ route('generate.pdf') }}">
                <button class="flex items-center px-5 py-1 hover:bg-customTextBlue hover:text-black cursor-pointer rounded-md generate-report-btn" style="background-color: #28a745; color: #fff; font-size: 15px">
                    Download as PDF
                </button>

                </a>
            @endif
        </div>
            @include('components.generate-pdf')
        </div>
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