propayl2.html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Information Page</title>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="dashboard.js" defer></script>
</head>

<body>
    <section id="menu">
        @if(Auth::user()->user_type === 'Admin')
            @include('components.admin-sidenav')
        @else
            @include('components.sidenav')
        @endif
    </section>

    <section id="interface">
        @include('components.headernav')

        <h3 class="i-name">
        Profile
        </h3>
        
        <div class="student-profile py-4">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                      <img class="profile_img" src="img/jeyd.jpg" alt="student dp">
                      <h3>Jade Riel Abuela</h3>
                      <h5>Software Developer</h5>
                      <br>
                      <h6>@jeydriyel123</h6>
                    </div>
                    <div class="card-body">
                        <input type="text" class="borderless-input" placeholder="Edit Bio">
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card shadow-sm">
                    <div class="card-header2 bg-transparent border-0">
                      <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Alumni Information</h3>
                    </div>
                    <div class="card-body pt-0">
                      <table class="table table-bordered">
                        <tr>
                          <th width="30%">First Name</th>
                          <td width="2%">:</td>
                          <td>Jade Riel</td>
                        </tr>
                        <tr>
                          <th width="30%">Last Name</th>
                          <td width="2%">:</td>
                          <td>Abuela</td>
                        </tr>
                        <tr>
                            <th width="30%">Email Address</th>
                            <td width="2%">:</td>
                            <td>jaderielabuela@student.laverdad.edu.ph</td>
                          </tr>
                        <tr>
                            <th width="30%">Course</th>
                            <td width="2%">:</td>
                            <td>Bachelor of Science in Information Systems (BSIS)</td>
                          </tr>
                          <tr>
                            <th width="30%">Batch Year</th>
                            <td width="2%">:</td>
                            <td>2023</td>
                          </tr>
                        <tr>
                          <th width="30%">Civil Status</th>
                          <td width="2%">:</td>
                          <td>Single</td>
                        </tr>
                        <tr>
                            <th width="30%">Employment Status</th>
                            <td width="2%">:</td>
                            <td>Employed</td>
                        </tr>
                        <tr>
                            <th width="30%">Industry</th>
                            <td width="2%">:</td>
                            <td>Technology</td>
                        </tr>
                        <tr>
                          <th width="30%">Post Graduation</th>
                          <td width="2%">:</td>
                          <td>-</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>   
    </section>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>

</body>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
</html>