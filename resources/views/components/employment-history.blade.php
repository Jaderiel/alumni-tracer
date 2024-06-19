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

        <div class="flex mt-5 justify-end mx-5 lg:mx-40">
            <a href="{{ route('add-past-employment.show') }}">
            <button class="up-event w-full">Add Past Employment <i class="fas fa-circle-plus"></i></button>
            </a>
        </div>

        @foreach ($employmentHistories as $history)
            <div class="bg-white mx-5 lg:mx-40 mt-5 p-4 flex flex-col gap-2 rounded-md shadow-lg hover:shadow-customYellow" data-id="{{ $history->id }}">
                <table class="table table-auto">
                    <tr class="hide-on-small">
                        <th width="30%">Job Title</th>
                        <td width="2%">:</td>
                        <td>{{ $history->job_title }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-2">
                        <h1 class="font-bold">Job Title</h1>
                        <p>{{ $history->job_title }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Company</th>
                        <td width="2%">:</td>
                        <td>{{ $history->company }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-2">
                        <h1 class="font-bold">Company</h1>
                        <p>{{ $history->company }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Industry</th>
                        <td width="2%">:</td>
                        <td>{{ $history->industry }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-2">
                        <h1 class="font-bold">Industry</h1>
                        <p>{{ $history->industry }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Date of Employment</th>
                        <td width="2%">:</td>
                        <td>{{ $history->date_of_employment }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-2">
                        <h1 class="font-bold">Date of Employment</h1>
                        <p>{{ $history->date_of_employment }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Salary</th>
                        <td width="2%">:</td>
                        <td>{{ $history->salary }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-2">
                        <h1 class="font-bold">Salary</h1>
                        <p>{{ $history->salary }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Location</th>
                        <td width="2%">:</td>
                        <td>{{ $history->location }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col">
                        <h1 class="font-bold">Location</h1>
                        <p>{{ $history->location }}</p>
                    </div>
                </table>
                <div class="flex justify-end">
                    <div class="bg-customDanger text-white w-20 py-1 flex justify-center items-center text-xs cursor-pointer delete-btn" style="padding: 8px 16px; border: none; border-radius: 5px; margin-bottom: 5px">Delete</div>
                </div>
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

    .table {
    margin-left: 15px;
    background-color: transparent;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: .10rem; 
    text-align: left;
    overflow-wrap: break-word;
}

.up-event{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 40px;
    padding: 10px 15px;
    border: 1px solid lightsteelblue;
    border-radius: 4px;
    background-color: #E8C766;
    outline: none;
    color: #000;
    text-decoration: none;
    font-size: 14px;
}

.up-event:hover{
    background-color: #ddaa10;
}

.delete-btn:hover {
    background-color: #800000;
}

.fas {
    color: #000 ;
    margin-left: 5px;
}

/* Media query to hide on small screens */
@media (max-width: 600px) {
    .hide-on-small {
        display: none;
    }
}
</style>
