<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .section {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .head {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .head h1{
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 5px;
            font-weight: bold;
            color: white;
            background-color: #162F65;
        }

        .section h2 {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .section ul {
            list-style-type: none;
            padding: 0;
        }

        .section ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="head">
            <h1>Analytics Report</h1>
        </div>

        <div class="section">
            <h2>Alumni Analytics</h2>
            <ul>
                @foreach ($userAnalytics['labels'] as $index => $label)
                    <li>{{ $label }}: {{ $userAnalytics['counts'][$index] }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Alumni Employment Analytics</h2>
            <p>Employed Alumni: {{ $employmentAnalytics['employedCount'] }}</p>
            <p>Unemployed Alumni: {{ $employmentAnalytics['unemployedCount'] }}</p>
        </div>

        <div class="section">
            <h2>Alumni Alignment to Course</h2>
            <p>Aligned: {{ $alignedUsersAnalytics['alignedUsersCount'] }}</p>
            <p>Unaligned: {{ $alignedUsersAnalytics['unalignedUsersCount'] }}</p>
        </div>

        <div class="section">
            <h2>Business Ownership Analytics</h2>
            <p>Owned Business: {{ $businessAnalytics['ownedBusinessCount'] }}</p>
            <p>Not Owned Business: {{ $businessAnalytics['doNotOwnedBusinessCount'] }}</p>
        </div>

        <div class="section">
            <h2>Salary Range Analytics</h2>
            <ul>
                @foreach ($salaryRange['salaryCounts'] as $salaryCount)
                    @if ($salaryCount->annual_salary !== null)
                        <li>{{ $salaryCount->annual_salary }}: {{ $salaryCount->user_count }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>User Locations</h2>
            <ul>
                @foreach ($userLocations as $location)
                    @if ($location)
                        <li>{{ $location }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>User Degrees</h2>
            <ul>
                @foreach ($userDegrees as $degree)
                    <li>{{ $degree }}</li>
                @endforeach
            </ul>
        </div>

    </div>

</body>
</html>
