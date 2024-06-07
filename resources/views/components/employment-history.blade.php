<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment History</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body style="margin-top: 70px">
    @include('main')
    
    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name-user">
        <a href="{{ route('profile.edit') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>Employment History
        </h3>

        <div class="flex justify-end mx-40">
            <div class="flex items-center gap-4 bg-customYellow px-4 py-1 hover:bg-customTextBlue hover:text-white cursor-pointer">
            <i class="fas fa-circle-plus"></i>
            <p>Add Past Employment</p>
            </div>
        </div>

        @foreach ($employmentHistories as $history)
            <div class="bg-white mx-40 mt-5 p-4 flex flex-col gap-2 rounded-md shadow-lg hover:shadow-customYellow" data-id="{{ $history->id }}">
                <div class="flex justify-end">
                    <div class="bg-customDanger text-white hover:bg-customTextBlue hover:text-black w-20 py-1 flex justify-center items-center text-xs cursor-pointer delete-btn">Delete</div>
                </div>
                <p><strong>Job Title:</strong> {{ $history->job_title }}</p>
                <p><strong>Company:</strong> {{ $history->company }}</p>
                <p><strong>Industry:</strong> {{ $history->industry }}</p>
                <p><strong>Date of employment:</strong> {{ $history->date_of_employment }}</p>
                <p><strong>Salary:</strong> {{ $history->salary }}</p>
                <p><strong>Location:</strong> {{ $history->location }}</p>
            </div>
        @endforeach

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this employment history?')) {
                        var parentDiv = button.closest('.bg-white');
                        var id = parentDiv.getAttribute('data-id');

                        // Get CSRF token value from meta tag
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        // Send AJAX request to delete the record
                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', '/employment-history/' + id, true);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Set CSRF token in request header
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    alert('Employment history deleted successfully.');
                                    location.reload(); // Reload the page after successful deletion
                                } else {
                                    alert('Error deleting employment history.');
                                }
                            }
                        };
                        xhr.send();
                    }
                });
            });
        });
    </script>
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
