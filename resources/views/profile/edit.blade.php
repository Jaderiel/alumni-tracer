<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/job-post.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body style="margin-top: 65px">
    @include('main')

    <section id="interface" class="ml-0 lg:ml-72 w-full flex flex-col justify-center">

    <h3 class="i-name py-4 px-10">
        <a href="{{ route('user-profile') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a> Profile Settings
    </h3>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="bg-white mx-4 lg:mx-10">
        <div class="border border-black">
            <div class="heading">
                USER INFORMATION
            </div>
    
            <div class="panel-btn">
                <div class="row flex flex-col lg:flex-row justify-center lg:justify-between">
                    <div class="flex flex-col lg:flex-row ml-4 mt-2">
                        <div class="h-[100px] w-[100px] overflow-hidden relative ml-0 lg:ml-4 rounded-full border-2 border-gray-500" >
                            @if (Auth::user()->profile_pic)
                            <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture" style="height: 100px; width: 100px; object-fit: cover;"> 
                            @else
                            <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Placeholder Profile Picture" style="height: 100%; width: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <input id="file-upload" type="file" name="profile_pic" accept="image/*" class="px-0 lg:px-2 py-2 lg:py-0 self-start lg:self-end" >
                    </div>

                    <div class="flex ml-3 h-full">
                            <button type="submit" class="btn-save"><i class="fa-regular fa-bookmark"></i> Save</button>
                        </form>
                        <form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                            <button class="delete-button" type="submit"><i class="fa-solid fa-user-xmark"></i> Delete</button>
                        </form>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="first_name" class="label">First Name</label>
                        <div class="border-2 w-full p-2">
                            
                            <input type="text" class="w-full outline-none" id="first_name" name="first_name" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="middle_name" class="label">Middle Name</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="last_name" class="label">Last Name</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="last_name" name="last_name" value="{{ $user->last_name }}">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="course" class="label">Course</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="course" name="course"> <!-- Added name attribute -->
                                <option value="{{ $user->course }}">{{ $user->course }}</option>
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
                    </div>
                    <div class="w-full">
                        <label for="batch" class="label">Batch</label>
                        <div class="border-2 w-full p-2">
                                <select class="w-full outline-none" name="batch" id="batch" required>
                                    <option value="{{ $user->batch }}">{{ $user->batch }}</option>
                                        @for ($year = date('Y'); $year >= 2006; $year--)
                                        @php
                                        $nextYear = $year + 1;
                                        @endphp
                                        <option value="{{ $year }} - {{ $nextYear }}">{{ $year }}-{{ $nextYear }}</option>
                                        @endfor
                                </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="email" class="label">Email Address</label>
                        <div class="border-2 w-full p-2">
                            <input type="email" class="w-full outline-none" id="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="username" class="label">Username</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="username" name="username" value="{{ $user->username }}" readonly style="pointer-events: none">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <a href="{{ route('change-password.show') }}">
                        <div class="w-full">
                            <div class="bg-customBlue text-white text-xs py-2 px-4 change-btn" style="margin-top: 10px">Change Password</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="heading" style="margin-top: 30px">
                USER EMPLOYMENT INFORMATION
            </div>
        
            <div class="panel-btn flex flex-col my-4">
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="employment" class="label">Current Status</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="employmentStatus" name="employment_status">
                                <option value="employed" {{ $user->employment && $user->employment->is_employed ? 'selected' : '' }}>Employed</option>
                                <option value="unemployed" {{ (!$user->employment || !$user->employment->is_employed) ? 'selected' : '' }}>Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="job" class="label">Job Title</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="job" name="job_title" value="{{ $user->employment ? $user->employment->job_title : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="company" class="label">Company</label>
                        <div class="border-2 w-full p-2">
                            <input type="text" class="w-full outline-none" id="company" name="company_name" value="{{ $user->employment ? $user->employment->company_name : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="industry" class="label">Industry</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="industry" name="industry" value="{{ $user->employment ? $user->employment->industry : '' }}">
                                <option value="{{ $user->employment ? $user->employment->industry : '' }}" disabled selected>{{ $user->employment ? $user->employment->industry : '' }}</option>
                                <option value="IT Industry">IT Industry</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Finance">Finance</option>
                                <option value="Education">Education</option>
                                <option value="Construction">Construction</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Retail">Retail</option>
                                <option value="Hospitality">Hospitality</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Entertainment">Entertainment</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="w-full">
                        <label for="date" class="label">Date of First Employment</label>
                        <div class="border-2 w-full p-2">
                            <input type="date" class="w-full outline-none" id="date" name="date_of_first_employment" value="{{ $user->employment ? $user->employment->date_of_first_employment : '' }}">
                        </div>
                    </div> -->
                </div>

                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <label for="date2" class="label">Date of Employment</label>
                        <div class="border-2 w-full p-2">
                            <input type="date" class="w-full outline-none" id="date2" name="date_of_employment" value="{{ $user->employment ? $user->employment->date_of_employment : '' }}">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="salary" class="label">Salary per Month</label>
                        <select class="border-2 w-full p-2" id="salaryy" name="annual_salary">
                            <option value="{{ $user->employment ? $user->employment->annual_salary : '' }}" disabled selected>{{ $user->employment ? $user->employment->annual_salary : '' }}</option>
                            <option value="below ₱4000">below ₱4,000</option>
                            <option value="₱4001 - ₱8000">₱4,001 - ₱8,000</option>
                            <option value="₱8001 - ₱16000">₱8,001 - ₱16,000</option>
                            <option value="₱16001 - ₱25000">₱16,001 - ₱25,000</option>
                            <option value="₱25001 - ₱33000">₱25,001 - ₱33,000</option>
                            <option value="₱33001 - ₱41000">₱33,001 - ₱41,000</option>
                            <option value="₱41001 - ₱50000">₱41,001 - ₱50,000</option>
                            <option value="₱50001 - ₱58000">₱50,001 - ₱58,000</option>
                            <option value="₱58001 - ₱66000">₱58,001 - ₱66,000</option>
                            <option value="₱66001 - ₱75000">₱66,001 - ₱75,000</option>
                            <option value="₱75001 - ₱83000">₱75,001 - ₱83,000</option>
                            <option value="₱83001 - ₱91000">₱83,001 - ₱91,000</option>
                            <option value="₱91001 - ₱100000">₱91,001 - ₱100,000</option>
                            <option value="₱100001 above">₱100,001 above</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                    <label for="location" class="label">Location</label>
                    <div class="border-2 w-full p-2">
                        <select id="country" class="w-full outline-none">
                            <option value="" selected disabled>Select Country</option>
                        </select>
                    </div>
                    </div>
                    <div class="w-full">
                        <br>
                        <div class="border-2 w-full p-2">
                        <select id="region" class="w-full outline-none" disabled>
                            <option class="w-full outline-none" value="" selected disabled>Select Region</option>
                        </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <br>
                        <div class="border-2 w-full p-2">
                        <select id="province" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Province</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                    <div class="w-full">
                        <div class="border-2 w-full p-2">
                        <select id="city" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select City/Municipality</option>
                        </select>
                        </div>
                    </div>
                    <div class="w-full">
                        
                        <div class="border-2 w-full p-2">
                        <select id="barangay" class="w-full outline-none" disabled>
                            <option value="" selected disabled>Select Barangay</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2">
                    <div class="border-2 w-full p-2">
                        <input type="text" id="location" class="w-full outline-none" name="company_address" value="{{ $user->employment ? $user->employment->company_address : '' }}" placeholder="Location" readonly>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                        <a href="{{ route('employment-history.show') }}">
                            <div class="w-full">
                                <div class="bg-customBlue text-white text-xs py-2 px-4 change-btn">Employment History</div>
                            </div>
                        </a>
                    </div>
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                            <div class="w-full">
                                <div id="endEmploymentBtn" class="bg-customDanger text-white text-xs py-2 px-4 cursor-pointer change-btn">End Curent Employment</div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="heading" style="margin-top: 30px">
                USER BUSINESS INFORMATION
            </div>

            <div class="panel-btn">
                <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-6">
                    <div class="w-full">
                        <label for="employment" class="label">Do you own a business?</label>
                        <div class="border-2 w-full p-2">
                            <select class="w-full outline-none" id="ownedBusiness" name="is_owned_business">
                                <option value="yes" {{ $user->employment && $user->employment->is_owned_business ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ (!$user->employment || !$user->employment->is_owned_business) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="heading">
                USER POST-GRADUATION INFORMATION
            </div>
                    
            <div class="panel-btn">
    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2 degree-status-fields" style="display: none; margin-top: 20px">
        <!-- Degree input fields -->
        <div class="w-full">
            <label for="degree" class="label">Degree Status</label>
            <div class="border-2 w-full p-2">
                <select class="w-full outline-none" id="degree" name="degree">
                    <option value="">None</option>
                    <option value="Doctoral">Doctoral</option>
                    <option value="Master's">Master's</option>
                    <option value="Bachelor's">Bachelor's</option>
                    <option value="Associate">Associate</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Certificate">Certificate</option>
                </select>
            </div>
        </div>
        <div class="w-full">
            <label for="school" class="label">School</label>
            <div class="border-2 w-full p-2">
                <input type="text" name="school" class="w-full outline-none">
            </div>
        </div>
        <div class="w-full">
            <label class="label">Ongoing</label>
            <div class="border-2 w-full p-2" style="margin-bottom: 25px">
                <select class="w-full outline-none" name="is_ongoing">
                    <option value="1" {{ isset($degree) && $degree->is_ongoing ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ isset($degree) && !$degree->is_ongoing ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn-save" style="width: 350px; height: 30px; margin-top: 30px"><i class="fa-regular fa-bookmark"></i> Save Degree</button>
    </div>
    
    <!-- Degrees loop -->
    @if($degrees->count() > 0)
        @foreach($degrees as $degree)
            <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                <div class="w-full">
                    <label for="degree" class="label">Degree</label>
                    <div class="border-2 w-full p-2">
                        <input type="text" class="w-full outline-none" name="degree" value="{{ $degree->degree }}">
                    </div>
                </div>
                <div class="w-full">
                    <label for="school" class="label">School</label>
                    <div class="border-2 w-full p-2">
                        <input type="text" class="w-full outline-none" name="school" value="{{ $degree->school }}">
                    </div>
                </div>
                <div class="w-full">
                    <label for="status" class="label">Status</label>
                    <div class="border-2 w-full p-2">
                        <input type="text" class="w-full outline-none" name="status" value="{{ $degree->status }}">
                        <p class="text-xs" style="color: {{ $degree->is_ongoing ? 'green' : 'white' }}; background-color: {{ $degree->is_ongoing ? 'transparent' : 'green' }}; border-radius: {{ $degree->is_ongoing ? '' : '5px' }}; padding: {{ $degree->is_ongoing ? '' : '2px 5px' }}">
                            {{ $degree->is_ongoing ? 'Ongoing' : 'Done' }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="label" style="margin: 10px 10px; color: red">No degrees found.</p>
    @endif
    
    <!-- Add degree button -->
    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2" style="margin-bottom: 30px">
        <div id="add-degree-btn" class="bg-customBlue text-white text-xs py-2 px-4 cursor-pointer change-btn">Add Degree</div>
    </div>
</div>
<br>
</section>

</body>
<script src="{{ asset('js/job-location.js') }}"></script>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post? This action cannot be undone.');
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const employmentStatus = document.getElementById('employmentStatus');
        const fieldsToToggle = ['job', 'company', 'industry', 'date2', 'salaryy', 'country'];

        function clearFields() {
            document.getElementById('job').value = '';
            document.getElementById('company').value = '';
            document.getElementById('industry').value = '';
            document.getElementById('date2').value = '';
            document.getElementById('salaryy').value = '';
            document.getElementById('location').value = '';
        }

        function toggleFields() {
            const isUnemployed = employmentStatus.value === 'unemployed';
            fieldsToToggle.forEach(id => {
                doent.getElementById(id).disabled = isUnemployed;
            });

            if (isUnemployed) {
                clearFields();
            }
        }

        employmentStatus.addEventListener('change', toggleFields);
        toggleFields(); // Initial call to set the correct state on page load
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('endEmploymentBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link

        // Show confirmation dialog
        var confirmEnd = confirm('Are you sure you want to end this employment?');

        if (confirmEnd) {
            // If the user clicked "OK", proceed with ending the employment

            // Extract values from HTML elements
            var jobTitle = document.getElementById('job').value;
            var company = document.getElementById('company').value;
            var industry = document.getElementById('industry').value;
            var dateOfEmployment = document.getElementById('date2').value;
            var salary = document.getElementById('salaryy').value;
            var location = document.getElementById('location').value;

            // Debugging: Log the value of salary to the console
            console.log('Salary:', salary);

            // Get CSRF token value from meta tag
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Send AJAX request to backend
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/end-employment', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Set CSRF token in request header
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    console.log('AJAX request completed. Status:', xhr.status);
                    if (xhr.status === 200) {
                        // Success
                        console.log('Employment ended successfully. You can check it on you employment history');
                        alert('Employment ended successfully.');
                        window.location.reload(true);
                    } else {
                        // Error
                        alert('Error ending employment: Please fill out all the fields', xhr.responseText);
                    }
                }
            };
            var data = JSON.stringify({
                job_title: jobTitle,
                company: company,
                industry: industry,
                date_of_employment: dateOfEmployment,
                salary: salary,
                location: location
            });
            console.log('Sending data:', data);
            xhr.send(data);
        }
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var employmentStatus = document.getElementById('employmentStatus');
    var endEmploymentBtn = document.getElementById('endEmploymentBtn');

    function toggleEndEmploymentButton() {
        if (employmentStatus.value === 'unemployed') {
            endEmploymentBtn.classList.add('disabled');
            endEmploymentBtn.style.pointerEvents = 'none'; // Disable link clicking
        } else {
            endEmploymentBtn.classList.remove('disabled');
            endEmploymentBtn.style.pointerEvents = 'auto'; // Enable link clicking
        }
    }

    // Initial check
    toggleEndEmploymentButton();

    // Add event listener to monitor changes
    employmentStatus.addEventListener('change', toggleEndEmploymentButton);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addDegreeBtn = document.getElementById('add-degree-btn');
        const degreeStatusFields = document.querySelector('.degree-status-fields');

        addDegreeBtn.addEventListener('click', function() {
            degreeStatusFields.style.display = 'flex';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteDegreeButtons = document.querySelectorAll('.delete-degree-btn');

        deleteDegreeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const degreeId = button.getAttribute('data-degree-id');

                // Show confirmation dialog
                const confirmDelete = confirm('Are you sure you want to delete this degree?');

                if (confirmDelete) {
                    // User confirmed deletion
                    // Send AJAX request to delete the degree
                    fetch(`/degrees/${degreeId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Degree deleted successfully
                            // You can reload the page or remove the deleted degree from the UI
                            location.reload(); // Reload the page
                        } else {
                            // Error deleting degree
                            console.error('Error deleting degree');
                        }
                    })
                    .catch(error => {
                        console.error('Error deleting degree:', error);
                    });
                }
            });
        });
    });
</script>

</html>


<style>
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

.label {
    color: #3058af;
}

.disabled {
    background: #d3d3d3;
}

button {
    border: none;
    color: #fff;
    margin: 0;
    border-radius: 4px;
    font-size: 10px;
    cursor: pointer;
}

.btn-save {
    background: #00A36C; 
    padding: 0;
    
}

.btn-save:hover {
    background: #016443; 
}

.change-btn:hover {
    background-color: #000033;
}
</style>