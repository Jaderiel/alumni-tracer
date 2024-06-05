<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni List Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/jobs.css') }}"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body style="margin-top: 70px">
    @include('main')

    <section id="" class="ml-0 lg:ml-72 w-full">

            <h3 class="i-name">
                Alumni List
            </h3>

        <div class="find flex flex-col lg:flex-row justify-center lg:justify-between mx-0 lg:mx-10 gap-4 pt-4 lg:pt-4">
            <div class="search-course w-full lg:w-2/5">
                <select name="course" id="courseFilter">
                    <option value="" selected disabled>Course</option>
                    <option value="all">All</option>
                    <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BAB)</option>
                    <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
                    <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology (BSAT)</option>
                    <option value="Bachelor of Science in Accounting Information Systems">Bachelor of Science in Accounting Information Systems (BSAIS)</option>
                    <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work (BSSW)</option>
                    <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems (BSIS)</option>
                    <option value="Associate in Computer Technology">Associate in Computer Technology (ACT)</option>
                    <option value="Computer Technology">Computer Technology (CT)</option>
                    <option value="Computer Programming">Computer Programming (CP)</option>
                    <option value="Health Care Services">Health Care Services (HCS)</option>
                    <option value="International Cookery">International Cookery (IC)</option>
                    <option value="Mass Communication">Mass Communication (MC)</option>
                    <option value="Nursing Student">Nursing Student (NS)</option>
                    <option value="Office Management">Office Management (OM)</option>
                </select>
            </div>
            <div class="search-batch w-full lg:w-3/12">
                <select name="batch" id="batchFilter">
                    <option value="" selected disabled>Batch</option>
                    <option value="all">All</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
            <div class="search w-full lg:w-3/12">
                <i class="fa-solid fa-search"></i>
                <input id="searchInput" type="text" placeholder="Search...">
            </div>
        </div>

            @if (session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: .25rem;">
                    {{ session('success') }}
                </div>
            @endif

        <div class="px-5 lg:px-10 py-5">
            <div class="board-list flex justify-center m-0 w-full">
                <table width="100%" id="userTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td class="hide-on-small">Course</td>
                            <td class="hide-on-small">Batch</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($verifiedAlumni as $user)
                        <tr>
                            <td>
                                <div>
                                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </td>
                            <td class="hide-on-small">
                                <div>
                                    <p>{{ $user->course }}</p>
                                </div>
                            </td>
                            <td class="hide-on-small">
                                <div>
                                    <p>{{ $user->batch }}</p>
                                </div>
                            </td>
                            <td class="action flex-col flex lg:flex-row items-center gap-2">
                                <a href="{{ route('profile.show', ['id' => $user->id]) }}"><button>View</button></a>
                                @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
                                <form id="delete-form" action="{{ route('user.delete', ['userId' => $user->id]) }}" method="POST" onsubmit="return confirmDelete();">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="" style="background-color: maroon;">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchInput');
    const courseFilter = document.getElementById('courseFilter');
    const batchFilter = document.getElementById('batchFilter');
    const userTable = document.getElementById('userTable').querySelectorAll('tbody tr');

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCourse = courseFilter.value.toLowerCase();
        const selectedBatch = batchFilter.value.toLowerCase();

        userTable.forEach(row => {
            const name = row.cells[0].innerText.toLowerCase();
            const course = row.cells[1].innerText.toLowerCase();
            const batch = row.cells[2].innerText.toLowerCase();

            const matchesSearchTerm = name.includes(searchTerm) || course.includes(searchTerm) || batch.includes(searchTerm);
            const matchesCourseFilter = selectedCourse === 'all' || course.includes(selectedCourse);
            const matchesBatchFilter = selectedBatch === 'all' || batch.includes(selectedBatch);

            if (matchesSearchTerm && matchesCourseFilter && matchesBatchFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterRows);
    courseFilter.addEventListener('change', filterRows);
    batchFilter.addEventListener('change', filterRows);
});

function confirmDelete() {
        return confirm('Are you sure you want to delete this post? This action cannot be undone.');
    }

    </script>

</body>
<script src="{{ asset('js/header.js') }}"></script>
</html>

<style>
    /* Default styles */
.hide-on-small {
    display: table-cell;
}

/* Media query to hide on small screens */
@media (max-width: 600px) {
    .hide-on-small {
        display: none;
    }
}

</style>
