<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: 20px 0;
        }

        /* .download-btn {
            padding: 10px 10px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: #2e59d9;
        } */
    
        .dashboard {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px;
        }
        .chart-container {
            width: 100%;
            height: 100%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        /* .chart-container canvas {
            width: 100% !important;
            height: auto !important;
        } */

        .chart-container.user {
            grid-column: span 2;
        }

        .generate-btn {
        background-color: #007bff;
        }

        .generate-btn:hover {
            background-color: #0056b3;
        }

        .download-btn {
        background-color: #00A36C;
        }

        .download-btn:hover {
            background-color: #016443;
        }

    </style>

<body class="w-full bg-customBgColor relative flex">
    @include('main')

    <section id="interface">
        <div class="header">
            <h3 class="i-name">Analytics</h3>
            <!-- <button class="download-btn" onclick="downloadCharts()">Download Charts</button> -->
        </div>
            
            <!-- <canvas id="userChart" width="400" height="200"></canvas>
            <canvas id="employmentChart" width="400" height="200"></canvas>
            <canvas id="alignedAlumniChart" width="400" height="200"></canvas>
            <canvas id="ownedBusinessChart" width="400" height="200"></canvas>
            <canvas id="salaryChart" width="400" height="200"></canvas>
            -->
        <div class="flex gap-4 justify-end mx-5">
        @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
            <a href="{{ route('preview.show') }}">
                <button class="generate-btn flex items-center gap-4 px-5 py-1 cursor-pointer rounded-md generate-report-btn" style="color: #fff; font-size: 15px">Generate Report</button>
            </a>
            <a href="{{ route('generate.pdf') }}">
                <button class="download-btn flex items-center gap-4 px-5 py-1 cursor-pointer rounded-md generate-report-btn" style="color: #fff; font-size: 15px">Download as PDF</button>
            </a>
        @endif
        </div>

        <div class="dashboard">
            <div class="chart-container user">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>TOTAL NUMBER OF ALUMNI USING THE SYSTEM, CATEGORIZED BY COURSE</b></h5>
                <canvas id="userChart"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>PERCENTAGE OF EMPLOYED AND UNEMPLOYED ALUMNI</b></h5>
                <canvas id="employmentChart"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>PERCENTAGE OF ALUMNI JOB ALIGNED TO THEIR COURSES</b></h5>
                <canvas id="alignedAlumniChart"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>PERCENTAGE ANALYSIS OF ALUMNI: BUSINESS OWNERS AND NON-OWNERS</b></h5>
                <canvas id="ownedBusinessChart"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>ALUMNI MONTHLY SALARY RANGE ANALYSIS</b></h5>
                <canvas id="salaryChart"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>ALUMNI EMPLOYMENT LOCATION ANALYSIS</b></h5>
                <canvas id="locationChart" width="400" height="200"></canvas>
            </div>
            <div class="chart-container">
                <h5 style="font-size: 15px; text-align: center; margin-bottom: 10px"><b>ALUMNI DEGREES HELD ANALYSIS</b></h5>
                <canvas id="degreeChart" width="400" height="200"></canvas>
            </div>
            @if(auth()->check() && (auth()->user()->user_type == 'Admin' || Auth::user()->user_type === 'Super Admin'))
            <div class="chart-container">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
                <div id="user-count-container"></div>
            </div>
            @endif
        </div>
    </section>
</div>

</body>
<script src="{{ asset('js/profile.js') }}"></script>
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
                        label: 'Monthly Salaries',
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/user-locations')
            .then(response => response.json())
            .then(data => {
                const locationCounts = {};

                data.forEach(location => {
                    // Check if location is not null or empty
                    if (location) {
                        // Split the location string by comma and trim any extra spaces
                        const parts = location.split(',').map(part => part.trim());
                        // Get the third part (index 2) of the split string
                        const middlePart = parts.length > 2 ? parts[2] : '';
                        // Count occurrences of each middlePart
                        if (middlePart) {
                            if (locationCounts[middlePart]) {
                                locationCounts[middlePart]++;
                            } else {
                                locationCounts[middlePart] = 1;
                            }
                        }
                    }
                });

                // Prepare data for the chart
                const labels = Object.keys(locationCounts);
                const counts = Object.values(locationCounts);

                // Create the chart
                const ctx = document.getElementById('locationChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'User Employment Locations',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
            })
            .catch(error => console.error('Error fetching company names:', error));
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/all-users')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('user-count-container');
                const totalAlumniCount = 2070; // Total number of alumni overall
                const alumniCount = data.alumniCount;
                const percentage = ((alumniCount / totalAlumniCount) * 100).toFixed(2); // Calculate percentage
                container.innerHTML = `
                    <p class="text-lg mb-2">Alumni Users: ${alumniCount}</p>
                    <p class="text-lg mb-2">Overall Alumni: ${totalAlumniCount}</p>
                    
                    <div class="flex flex-col justify-center items-center p-10">
                        <p class="text-6xl font-bold">${percentage}%</p>
                        <p class="text-xs">Percent of Alumni that are using the System</p>
                    </div>
                `;
            })
            .catch(error => console.error('Error fetching user count:', error));
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/all-degrees')
            .then(response => response.json())
            .then(data => {
                const degrees = data;
                const degreeCounts = {};
                degrees.forEach(degree => {
                    if (degreeCounts[degree]) {
                        degreeCounts[degree]++;
                    } else {
                        degreeCounts[degree] = 1;
                    }
                });

                const labels = Object.keys(degreeCounts);
                const counts = Object.values(degreeCounts);

                const ctx = document.getElementById('degreeChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Degrees Held by the Alumni',
                            data: counts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
            })
            .catch(error => console.error('Error fetching degrees:', error));
    });
</script>
</html>