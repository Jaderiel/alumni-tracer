<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="profile.js" defer></script>
</head>

<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name-user">
            Profile
        </h3>

        <div class="aa bg-white p-6 my-4 mx-4 lg:mx-10">
            <div class="flex items-baseline justify-between mx-0 lg:mx-33">
                <div class="flex flex-col lg:flex-row justify-center lg:justify-start gap-4 w-full items-center">
                    <div class="h-[100px] w-[100px] overflow-hidden relative rounded-full border-2 border-gray-500">
                        @if (Auth::user()->profile_pic)
                        <img src="{{ Auth::user()->profile_pic }}" alt="Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                        @else
                        <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div class="flex flex-col justify-center items-center lg:items-start">
                        <div class="flex gap-4">
                            <h1 class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                            @if (Auth::user()->degree)
                            <p>(</p>
                            @forelse ($degrees as $degree)
                            <p class="text-sm">{{ $degree->degree }},</p>
                            @empty
                            <p></p>
                            @endforelse
                            <p>)</p>
                            @endif
                        </div>
                        <p class="text-xs">{{ '@' . Auth::user()->username }}</p>
                    </div>
                    <div class="ml-0 lg:ml-40">
                        <a href="{{ route('profile.edit') }}">
                            <button class="but-set text-xs bg-customBlue text-white px-4 py-2 rounded-lg hover:bg-customTextBlue hover:text-black">Profile Settings</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="employment-info mx-0 lg:mx-33">
                <h4 class="info-title">Employment Information</h4>
                <table class="table table-auto">
                    <tr class="hide-on-small">
                        <th width="30%">Email Address</th>
                        <td width="2%">:</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Email Address</h1>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Course</th>
                        <td width="2%">:</td>
                        <td>{{ Auth::user()->course }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Course</h1>
                        <p>{{ Auth::user()->course }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Batch Year</th>
                        <td width="2%">:</td>
                        <td>{{ Auth::user()->batch }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Batch Year</h1>
                        <p>{{ Auth::user()->batch }}</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Employment Status</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                @if (Auth::user()->employment->is_employed == 1)
                                    Employed
                                @else
                                    Unemployed
                                @endif
                            @else
                                Employment information not available
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Employment Status</h1>
                        <p>@if (Auth::user()->employment)
                                @if (Auth::user()->employment->is_employed == 1)
                                    Employed
                                @else
                                    Unemployed
                                @endif
                            @else
                                Employment information not available
                            @endif</p>
                    </div>
                    <!-- <tr class="hide-on-small">
                        <th width="30%">Date of First Employment</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{Auth::user()->employment->date_of_first_employment}}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr> -->
                    <!-- <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Date of First Employment</h1>
                        <p>@if (Auth::user()->employment)
                                {{Auth::user()->employment->date_of_first_employment}}
                            @else
                                N/A
                            @endif</p>
                    </div> -->
                    <tr class="hide-on-small">
                        <th width="30%">Date of Employment</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{Auth::user()->employment->date_of_employment}}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Date of Employment</h1>
                        <p>@if (Auth::user()->employment)
                                {{Auth::user()->employment->date_of_employment}}
                            @else
                                N/A
                            @endif</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Salary</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{ Auth::user()->employment->annual_salary }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Salary</h1>
                        <p>@if (Auth::user()->employment)
                                {{ Auth::user()->employment->annual_salary }}
                            @else
                                N/A
                            @endif</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Industry</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{ Auth::user()->employment->industry }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Industry</h1>
                        <p>@if (Auth::user()->employment)
                                {{ Auth::user()->employment->industry }}
                            @else
                                N/A
                            @endif</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Job Title</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{ Auth::user()->employment->job_title }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Job Title</h1>
                        <p>@if (Auth::user()->employment)
                                {{ Auth::user()->employment->job_title }}
                            @else
                                N/A
                            @endif</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Company</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{ Auth::user()->employment->company_name }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Company</h1>
                        <p>@if (Auth::user()->employment)
                                {{ Auth::user()->employment->company_name }}
                            @else
                                N/A
                            @endif</p>
                    </div>
                    <tr class="hide-on-small">
                        <th width="30%">Location</th>
                        <td width="2%">:</td>
                        <td>
                            @if (Auth::user()->employment)
                                {{ ucwords(strtolower(Auth::user()->employment->company_address)) }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Location</h1>
                        <p>@if (Auth::user()->employment)
                                {{ ucwords(strtolower(Auth::user()->employment->company_address)) }}
                            @else
                                N/A
                            @endif</p>
                    </div>
                </table>
            </div>

            <div class="employment-info mx-0 lg:mx-33">
                <h4 class="info-title">Post-Graduation Information</h4>
                <table class="table table-auto">
                    <tr class="hide-on-small">
                        <th width="30%">Degree Status</th>
                        <td width="2%">:</td>
                        <td>{{ Auth::user()->degree }}</td>
                    </tr>
                    <div class="lg:hidden flex flex-col mb-4">
                        <h1 class="font-bold">Degree Status</h1>
                        <p>{{ Auth::user()->degree }}</p>
                    </div>
                </table>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
</html>


<style>
    .i-name {
        color: #2D55B4;
        font-size: 24px;
        font-weight: 700;
        margin-top: 20px;
        margin-left: 40px;
    }

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

    .employment-info {
        margin-top: 20px;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .employment-info h4 {
        color: #2D55B4;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
.table {
    margin-bottom: .5rem;
    margin-left: 15px;
    background-color: transparent;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: .35rem; 
    text-align: left;
    overflow-wrap: break-word;
}



/* Media query to hide on small screens */
@media (max-width: 600px) {
    .hide-on-small {
        display: none;
    }
}
</style>