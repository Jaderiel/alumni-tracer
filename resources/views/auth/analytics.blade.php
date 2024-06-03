<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="profile.js" defer></script>
</head>

<body class="w-full bg-customBgColor relative flex">
    @include('main')

    <section id="interface">

        <h3 class="i-name">
        Analytics
        </h3>
        
        <canvas id="userChart" width="400" height="200"></canvas>
        <canvas id="employmentChart" width="400" height="200"></canvas>
        <canvas id="alignedAlumniChart" width="400" height="200"></canvas>
        <canvas id="ownedBusinessChart" width="400" height="200"></canvas>
        <canvas id="salaryChart" width="400" height="200"></canvas>
        
    </section>
</div>

</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
<script>
$(document).ready(function() {
    // Fetch data from the backend
    $.ajax({
        url: '/user-analytics',
        type: 'GET',
        success: function(response) {
            // Render chart using Chart.js
            var ctx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.labels,
                    datasets: [{
                        label: 'User Count',
                        data: response.counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Fetch data from the backend for employment analytics
    $.ajax({
        url: '/user-aligned-analytics',
        type: 'GET',
        success: function(response) {
            // Render chart using Chart.js
            var ctx = document.getElementById('alignedAlumniChart').getContext('2d');
            var alignedAlumniChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['is Aligned', 'is not Aligned'],
                    datasets: [{
                        label: 'Employment Status',
                        data: [response.alignedUsersCount, response.unalignedUsersCount],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Fetch data from the backend for employment analytics
    $.ajax({
        url: '/user-employment-analytics',
        type: 'GET',
        success: function(response) {
            // Render chart using Chart.js
            var ctx = document.getElementById('employmentChart').getContext('2d');
            var employmentChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Employed', 'Unemployed'],
                    datasets: [{
                        label: 'Employment Status',
                        data: [response.employedCount, response.unemployedCount],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    // Fetch data from the backend for employment analytics
    $.ajax({
        url: '/user-owned-business',
        type: 'GET',
        success: function(response) {
            // Render chart using Chart.js
            var ctx = document.getElementById('ownedBusinessChart').getContext('2d');
            var ownedBusinessChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Owned a Business', 'Does not own a business'],
                    datasets: [{
                        label: 'Employment Status',
                        data: [response.ownedBusinessCount, response.doNotOwnedBusinessCount],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $.ajax({
        url: '/salary-range',
        type: 'GET',
        success: function(response) {
            // Extracting annual salaries and user counts from the response
            var salaries = [];
            var counts = [];
            response.salaryCounts.forEach(function(entry) {
                // Check if annual_salary is not null
                if (entry.annual_salary !== null) {
                    salaries.push(entry.annual_salary);
                    counts.push(entry.user_count);
                }
            });

            // Render chart using Chart.js
            var ctx = document.getElementById('salaryChart').getContext('2d');
            var salaryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: salaries,
                    datasets: [{
                        label: 'Annual Salaries',
                        data: counts,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)', // Changed color
                        borderColor: 'rgba(255, 159, 64, 1)', // Changed color
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
</html>