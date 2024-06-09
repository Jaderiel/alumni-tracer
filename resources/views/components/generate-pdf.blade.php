<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Report</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
    }
</style>
<body>

    <div style="display: flex;
        flex-direction: column;
        gap: 10px">
        <div style="display: flex;
        justify-content: center;">
            <h1>Analytics Report</h1>
            <img src="{{ asset('images/website-images/lvcc_logo.png') }}" alt="">
        </div>

        <div>
            <h2>Alumni Analytics</h2>
            <ul>
                @foreach ($userAnalytics['labels'] as $index => $label)
                    <p>{{ $label }}: {{ $userAnalytics['counts'][$index] }}</p>
                @endforeach
            </ul>
        </div>

        <div>
            <h2>Alumni Employment Analytics</h2>
            <p>Employed Alumni: {{ $employmentAnalytics['employedCount'] }}</p>
            <p>Unemployed Alumni: {{ $employmentAnalytics['unemployedCount'] }}</p>
        </div>

        <div>
            <h2>Alumni Alignment to Course</h2>
            <p>Count of Alumni that is Aligned to their course: {{ $alignedUsersAnalytics['alignedUsersCount'] }}</p>
            <p>Count of Alumni that is Unaligned to their course: {{ $alignedUsersAnalytics['unalignedUsersCount'] }}</p>
        </div>

        <div>
            <h2>Business Ownership Analytics</h2>
            <p>Owned Business Count: {{ $businessAnalytics['ownedBusinessCount'] }}</p>
            <p>Not Owned Business Count: {{ $businessAnalytics['doNotOwnedBusinessCount'] }}</p>
        </div>

        <div>
            <h2>Salary Range Analytics</h2>
            <ul>
                @foreach ($salaryRange['salaryCounts'] as $salaryCount)
                    @if ($salaryCount->annual_salary !== null)
                        <li>{{ $salaryCount->annual_salary }}: {{ $salaryCount->user_count }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div>
            <h2>User Locations</h2>
            <ul>
                @foreach ($userLocations as $location)
                    @if ($location)
                        <li>{{ $location }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div>
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
