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

        <h3 class="i-name">
            <a href="{{ route('alumni-list') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>
            Profile
        </h3>

        <div class="aa bg-white p-6 my-4 mx-4 lg:mx-10";>
            <div class="flex items-baseline justify-between mx-0 lg:mx-33" >
                <div class="flex items-center gap-4">
                    <div class="h-[100px] w-[100px] overflow-hidden relative rounded-full border-2 border-gray-500">
                        @if ($user->profile_pic)
                        <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture" style="height: 100%; width: 100%; object-fit: cover;"> 
                        @else
                        <img src="{{ asset('images/user_avatar.jpg') }}" alt="Placeholder Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div>
                        <h1 class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-xs">{{ '@' . $user->username }}</p>
                    </div>
                </div>
            </div>

            <div class="employment-info mx-0 lg:mx-33">
                <h4 class="info-title">Employment Information</h4>
                      <table class="table table-bordered">
                        <tr>
                          <th width="30%">Email Address</th>
                          <td width="2%">:</td>
                          <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                          <th width="30%">Course</th>
                          <td width="2%">:</td>
                          <td>{{ $user->course }}</td>
                        </tr>
                        <tr>
                          <th width="30%">Batch Year</th>
                          <td width="2%">:</td>
                          <td>{{ $user->batch }}</td>
                        </tr>
                        <tr>
                          <th width="30%">Employment Status</th>
                          <td width="2%">:</td>
                          <td>@if($user->employment->is_employed == 1)
                                Employed
                            @else
                                Unemployed
                            @endif
                          </td>
                        </tr>
                        <tr>
                            <th width="30%">Industry</th>
                            <td width="2%">:</td>
                            <td>{{ $user->employment->industry }}</td>
                        </tr>
                        <tr>
                            <th width="30%">Job Title</th>
                            <td width="2%">:</td>
                            <td>{{ $user->employment->job_title }}</td>
                          </tr>
                        <tr>
                          <th width="30%">Company</th>
                          <td width="2%">:</td>
                          <td>{{ $user->employment->company_name }}</td>
                        </tr>
                        <tr>
                          <th width="30%">Location</th>
                          <td width="2%">:</td>
                          <td>{{ ucwords(strtolower($user->employment->company_address)) }}</td>
                        </tr>
                      </table>
            </div>

            <div class="employment-info mx-0 lg:mx-33">
                <h4 class="info-title">Post-Graduation Information</h4>
                    <table class="table table-bordered">
                        <tr>
                          <th width="30%">Degree Status</th>
                          <td width="2%">:</td>
                          <td>{{ $user->degree }}</td>
                        </tr>
                    </table>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/profile.js') }}"></script>
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
}
</style>
