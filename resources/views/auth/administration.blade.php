<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

        <h3 class="i-name">Administration</h3>

        <div class="tabs">
            <a href="#" class="tab active" data-tab="account-approvals">Account Approvals</a>
            <a href="#" class="tab" data-tab="gallery-approvals">Gallery Approvals</a>
            <a href="#" class="tab" data-tab="job-approvals">Job Approvals</a>
            <a href="#" class="tab" data-tab="role-setting">Role Setting</a>
            <a href="#" class="tab" data-tab="create-account">Create Account</a>
        </div>

        <div id="account-approvals" class="tab-content active">
        <div>
            @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: .25rem;">
                {{ session('success') }}
            </div>
            @endif
            <ul>
                
                <div class="board-list">
                    <table width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Course</td>
                                <td>Batch</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unverifiedUsers as $user)
                            <tr>
                            <td>
                                <div>
                                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{ $user->course }}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{ $user->batch }}</p>
                                </div>
                            </td>
                                @unless($user->is_email_verified)
                                    <td class="action" style="display: flex">
                                        <a href="#" class="button approve-btn" data-form-id="{{ 'form-'.$user->id }}">Approve</a>
                                        <form id="{{ 'form-'.$user->id }}" method="POST" action="{{ route('user.approve', ['userId' => $user->id]) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                        <form action="{{ route('user.delete', ['userId' => $user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="button delete-btn" style="background-color: maroon;">Delete</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button style="padding: 10px; border-radius: 10px; background-color: gray; color: white;" disabled>approved</button>
                                    </td>
                                    <td></td>
                                @endunless
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </ul>
        </div>
        </div>
        <div id="gallery-approvals" class="tab-content">
            <!-- Content for Role Setting tab -->
            <p>Content for Gallery Approvals tab</p>
        </div>
        <div id="job-approvals" class="tab-content">
            <!-- Content for Role Setting tab -->
            <p>Content for job Approvals tab</p>
        </div>
        <div id="role-setting" class="tab-content">
            <!-- Content for Role Setting tab -->
            <p>Content for Role Setting tab</p>
        </div>
        <div id="create-account" class="tab-content">
            <!-- Content for Create Account tab -->
            <p>Content for Create Account tab</p>
        </div>
    </section>
</body>
<script src="{{ asset('js/header.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all tabs and tab contents
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        // Add click event listener to each tab
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and tab contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to the clicked tab
                tab.classList.add('active');

                // Show the corresponding tab content
                const tabName = tab.getAttribute('data-tab');
                const tabContent = document.getElementById(tabName);
                tabContent.classList.add('active');
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.approve-btn').click(function(e) {
            e.preventDefault();
            console.log('Approve button clicked'); // Debug statement
            var formId = $(this).data('form-id');
            $('#' + formId).submit();
        });

        $('.delete-btn').click(function(e) {
            if (!confirm('Are you sure you want to delete this user?')) {
                e.preventDefault();
            }
        });
    });
</script>


</html>

<style>
        .tabs {
            margin-top: 20px;
            display: flex;
            justify-content: start;
        }
        
        .tab {
            padding: 10px 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        
        .tab:hover {
            background-color: #ddd;
        }
        
        .tab.active {
            background-color: #fff;
            border-bottom: 1px solid #fff;
        }
        
        /* Content for each tab */
        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        
        .tab-content.active {
            display: block;
        }
</style>
