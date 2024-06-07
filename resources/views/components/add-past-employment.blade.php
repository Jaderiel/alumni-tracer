<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Past Employment</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body style="margin-top: 70px">
    @include('main')

    <section class="ml-0 lg:ml-72 w-full flex flex-col justify-center">
        <h3 class="i-name-user">
            <a href="{{ route('employment-history.show') }}" class="back-link"><i class="fa-solid fa-angles-left"></i> Back</a>Add Past Employment
        </h3>

        <div class="bg-white mx-4 lg:mx-10 mt-4">
            <div class="border border-black">
                <div class="heading">
                    USER PAST EMPLOYMENT INFORMATION
                </div>

                <div class="panel-btn flex flex-col my-4">
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                        <div class="w-full">
                            <label for="job" class="label">Job Title</label>
                            <div class="border-2 w-full p-2">
                                <input type="text" class="w-full outline-none" id="job" name="job_title" value="">
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="company" class="label">Company</label>
                            <div class="border-2 w-full p-2">
                                <input type="text" class="w-full outline-none" id="company" name="company" value="">
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="industry" class="label">Industry</label>
                            <div class="border-2 w-full p-2">
                                <select class="w-full outline-none" id="industry" name="industry" value="">
                                    <option value="" disabled selected></option>
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
                    </div>

                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 my-2">
                        <div class="w-full">
                            <label for="date2" class="label">Date of Employment</label>
                            <div class="border-2 w-full p-2">
                                <input type="date" class="w-full outline-none" id="date2" name="date_of_employment" value="">
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="salary" class="label">Salary per Month</label>
                            <select class="border-2 w-full p-2" id="salaryy" name="salary">
                                <option value="" disabled selected></option>
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
                            <input type="text" id="location" class="w-full outline-none" name="location" value="" placeholder="Location" readonly>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row mx-4 lg:mx-10 gap-2 lg:gap-4 my-2 justify-center">
                        <div id="submit-btn" class="bg-customGreen hover:bg-customTextBlue text-white px-4 py-1 cursor-pointer flex justify-center items-center">Add Employment</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
<script src="{{ asset('js/job-location.js') }}"></script>
<script>
    $(document).ready(function() {
        // AJAX setup with CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Submit form
        $('#submit-btn').click(function() {
            var jobTitle = $('#job').val();
            var company = $('#company').val();
            var industry = $('#industry').val();
            var dateOfEmployment = $('#date2').val();
            var salary = $('#salaryy').val();
            var locationInput = $('#location').val(); // renamed to avoid conflict

            $.ajax({
                type: 'POST',
                url: '{{ route('employment.history.store') }}',
                data: {
                    job_title: jobTitle,
                    company: company,
                    industry: industry,
                    date_of_employment: dateOfEmployment,
                    salary: salary,
                    location: locationInput // renamed to avoid conflict
                },
                success: function(response) {
                    alert(response.message);
                    window.location.reload(); // explicitly using window.location.reload to avoid conflict
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.message);
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
</style>
