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
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

        <h3 class="i-name">Administration</h3>

        <div class="tabs">
            <a href="#" class="tab active" data-tab="account-approvals">Account Approvals</a>
            <a href="#" class="tab" data-tab="gallery-approvals">Gallery Approvals</a>
            <a href="#" class="tab" data-tab="job-approvals">Job Approvals</a>
            <a href="#" class="tab" data-tab="role-setting">Role Setting</a>
            @if(auth()->check() && (auth()->user()->user_type == 'Super Admin'))
            <a href="#" class="tab" data-tab="create-account">Create Account</a>
            @endif
        </div>

        <div id="account-approvals" class="tab-content active">
            @include('components.account-approvals')
        </div>
        <div id="gallery-approvals" class="tab-content">
            @include('components.gallery-approvals')
        </div>
        <div id="job-approvals" class="tab-content">
            @include('components.job-approvals')
        </div>
        <div id="role-setting" class="tab-content">
            @include('components.role-setting')
        </div>
        <div id="create-account" class="tab-content">
            @include('components.create-account')
        </div>
    </section>
</body>

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

<script>
            function confirmDelete() {
                return confirm('Are you sure you want to delete this post? This action cannot be undone.');
            }
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
